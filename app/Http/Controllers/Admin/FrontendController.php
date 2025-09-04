<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogArticle;
use App\Models\Page;
use App\Models\Tag;
use App\Models\WebSetting;
use App\Models\User;
use Illuminate\Http\Request;
//For Schema
use Spatie\SchemaOrg\Schema;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOTools; // Complete SEO tool for flexibility
class FrontendController extends Controller
{

/*
|--------------------------------------------------------------------------
| Blog List
|--------------------------------------------------------------------------
*/
public function home()
{
    return view("frontend.index");
}

/*
|--------------------------------------------------------------------------
| Blog List
|--------------------------------------------------------------------------
*/

public function bloglist(Request $request, $categorySlug = null)
{
    $page       = Page::where('slug', 'blog-listing')->first();
    $setting    = WebSetting::first();
    $site_name  = config('seotools.opengraph.defaults.site_name', config('app.name'));

    // Blogs fetching
    if ($categorySlug) {
        $category = BlogCategory::where('slug', $categorySlug)
            ->where('status', 1)
            ->first();

        if ($category) {
            $blogs = BlogArticle::where('blog_category_id', $category->id)
                ->where('status', 1)
                ->orderBy('updated_at', 'desc') // newest first
                ->paginate(10);
        } else {
            $blogs = collect();
        }
    } else {
        $blogs = BlogArticle::where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->orderBy('updated_at', 'desc') // newest first
            ->paginate(10);
    }

    // Attach instructor data
    foreach ($blogs as $bc) {
        $bc->instructor = User::find($bc->author_id);
    }

    // Sidebar data
    $tags        = Tag::all();
    $categories  = BlogCategory::orderby('views_count', 'desc')->take(7)->get();
    $recentposts = BlogArticle::orderby('created_at', 'desc')->take(4)->get();

    // SEO Meta Info
    $meta_title = $page->page_name ?? "Latest Blog Articles - EstateGuideBlog";
    $meta_desc  = $page->meta_desc ?? "Browse fresh articles on real estate, finance, health, and more. Updated weekly on EstateGuideBlog.";

    SEOTools::setDescription($meta_desc);
    SEOTools::setCanonical(url()->current());

    // Open Graph
    SEOTools::opengraph()->setTitle($meta_title);
    SEOTools::opengraph()->setDescription($meta_desc);
    SEOTools::opengraph()->setUrl(url()->current());
    SEOTools::opengraph()->addImage(asset('storage/' . ($page->image ?? 'default.png')));
    SEOTools::opengraph()->addProperty('type', 'website');
    SEOTools::opengraph()->addProperty('site_name', 'EstateGuideBlog');

    // Twitter Card
    SEOTools::twitter()->setTitle($meta_title);
    SEOTools::twitter()->setDescription($meta_desc);
    SEOTools::twitter()->setUrl(url()->current());
    SEOTools::twitter()->setImage(asset('storage/' . ($page->image ?? 'default.png')));
    SEOTools::twitter()->setSite('@YourTwitterHandle'); // Replace with real handle
    SEOTools::twitter()->setType('summary_large_image');

    // Schema: Blog List
    $schema = [
        "@context"        => "https://schema.org",
        "@type"           => "ItemList",
        "itemListOrder"   => "http://schema.org/ItemListOrderDescending",
        "itemListElement" => []
    ];

    foreach ($blogs as $index => $blog) {
        $schema['itemListElement'][] = array_filter([
            "@type"     => "ListItem",
            "position"  => $index + 1,
            "url"       => route('blogshow', $blog->slug),
            "name"      => $blog->title,
            "description" => $blog->meta_desc ?? $blog->excerpt,
            "image"     => $blog->image ? asset('storage/' . $blog->image) : null,
            "item"      => [
                "@type"        => "Article",
                "headline"     => $blog->title,
                "description"  => $blog->meta_desc ?? $blog->excerpt,
                "datePublished"=> $blog->created_at->toIso8601String(),
                "author"       => [
                    "@type" => "Person",
                    "name"  => $blog->instructor->name ?? "Admin"
                ]
            ]
        ]);
    }

    // ✅ Add mainEntity here
    $schema['mainEntity'] = [
        "@type"         => "ItemList",
        "itemListOrder" => "http://schema.org/ItemListOrderDescending",
        "numberOfItems" => $blogs->count(),
    ];

    // Encode schema to JSON
    $schemaMarkup = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    // Schema: Breadcrumbs
    $breadcrumbs = [
        "@context"        => "https://schema.org",
        "@type"           => "BreadcrumbList",
        "itemListElement" => [
            [
                "@type"    => "ListItem",
                "position" => 1,
                "name"     => "Home",
                "item"     => route('home')
            ],
            [
                "@type"    => "ListItem",
                "position" => 2,
                "name"     => "Blog",
                "item"     => route('bloglist')
            ]
        ]
    ];

    if ($categorySlug && isset($category)) {
        $breadcrumbs['itemListElement'][] = [
            "@type"    => "ListItem",
            "position" => 3,
            "name"     => $category->title,
            "item"     => route('bloglist', $category->slug)
        ];
    }

    $breadcrumbsMarkup = json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    return view("frontend.blog-listing", compact(
        'page',
        'setting',
        'blogs',
        'categories',
        'recentposts',
        'tags',
        'schemaMarkup',
        'breadcrumbsMarkup'
    ));
}

/*
|--------------------------------------------------------------------------
| Blog Show
|--------------------------------------------------------------------------
*/

public function blogshow(BlogArticle $articleArticle, $slug)
{
    $setting = WebSetting::first();
    $article = BlogArticle::where('slug', $slug)->firstOrFail();

    $page = ['page_name' => $article->page_title];
    $meta_title = $article->title ?? "Welcome to Our Main article";
    $meta_desc = $article->meta_desc ?? "Description of the main article";
    $instructor = User::find($article->author_id);
    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    $tags = Tag::all();
    $categories = BlogCategory::orderby('views_count', 'desc')->where('status','1')->take(7)->get();
    $recentposts = BlogArticle::orderby('updated_at', 'desc')->where('status','1')->take(4)->get();

    $comments = $article->comments()
        ->whereNull('parent_id')
        ->where('is_approved', true)
        ->with(['replies' => function ($query) {
            $query->where('is_approved', true);
        }])
        ->get();

    $popularposts = BlogArticle::with('category')->where('status', '1')
        ->where('id', '!=', $article->id)
        ->orderBy('views_count', 'desc')
        ->take(3)
        ->get();

    // ------------------------------
    // ✅ SEO Meta and Open Graph
    // ------------------------------
    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    SEOTools::setCanonical(url()->current());

    SEOTools::opengraph()->setTitle($meta_title);
    SEOTools::opengraph()->setDescription($meta_desc);
    SEOTools::opengraph()->setUrl(url()->current());
    SEOTools::opengraph()->addProperty('type', 'article');
    SEOTools::opengraph()->addImage(asset('storage/' . ($article->image ?? 'default.png')));

    SEOTools::twitter()->setTitle($meta_title);
    SEOTools::twitter()->setDescription($meta_desc);
    SEOTools::twitter()->setImage(asset('storage/' . ($article->image ?? 'default.png')));
    SEOTools::twitter()->setUrl(url()->current());
    SEOTools::twitter()->setSite('@YourTwitterHandle'); // Replace with real handle
    SEOTools::twitter()->setType('summary_large_image');

    // ------------------------------
    // ✅ Article Schema JSON-LD
    // ------------------------------
    $schemaData = [
        "@context" => "https://schema.org",
        "@type" => "NewsArticle", // ✅ More specific than Article
        "headline" => $article->title,
        "description" => $meta_desc,
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => url()->current()
        ],
        "url" => url()->current(),
        "image" => asset('storage/' . ($article->image ?? 'default.png')),
        "datePublished" => $article->created_at->toIso8601String(),
        "dateModified" => $article->updated_at->toIso8601String(),
        "articleBody" => strip_tags($article->description), // ✅ Add full body text
        "author" => [
            "@type" => "Person",
            "name" => $instructor->name ?? 'Admin',
            "sameAs" => [
                $instructor->twitter ? "https://twitter.com/{$instructor->twitter}" : null,
                $instructor->insta ? "https://instagram.com/{$instructor->insta}" : null,
                // Add more social links if available
            ]
        ],
        "publisher" => [
            "@type" => "Organization",
            "@id" => route('home') . '#organization', // ✅ Added @id
            "name" => $site_name,
            "logo" => [
                "@type" => "ImageObject",
                "url" => asset('storage/settings/' . ($setting->site_logo ?? 'default.png'))
            ]
        ],
        "articleSection" => $article->category->name ?? "Blog",
    ];

    // Remove null values (for example, missing social URLs)
    $schemaData['author']['sameAs'] = array_values(array_filter($schemaData['author']['sameAs']));

    $schemaMarkup = json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    // ------------------------------
    // ✅ Breadcrumb Schema JSON-LD
    // ------------------------------
    $breadcrumbs = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Home",
                "item" => route('home')
            ],
            [
                "@type" => "ListItem",
                "position" => 2,
                "name" => "Blog",
                "item" => route('bloglist')
            ],
            [
                "@type" => "ListItem",
                "position" => 3,
                "name" => $article->title,
                "item" => url()->current()
            ]
        ]
    ];

    $breadcrumbsMarkup = json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    return view("frontend.blog-details", compact(
        'instructor',
        'page',
        'popularposts',
        'setting',
        'article',
        'tags',
        'categories',
        'recentposts',
        'comments',
        'schemaMarkup',
        'breadcrumbsMarkup'
    ));
}

/*
|--------------------------------------------------------------------------
| Contact Us
|--------------------------------------------------------------------------
*/

public function contact()
{
    $page = Page::where('slug', 'contact-us')->firstOrFail();
    $setting = WebSetting::first();

    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    $meta_title = $page->page_name ?? "$site_name - Contact Us";
    $meta_desc = $page->meta_desc ?? "Get in touch with $site_name for inquiries, support, or collaborations.";
    $meta_image = asset('storage/settings/' . ($setting->site_logo ?? 'logo.png'));
    $current_url = url()->current();
    $twitter_handle = '@EstateGuideBlog'; // ✅ Update with your real handle or leave empty if you don’t have

    // === SEO Meta Tags ===
    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    SEOTools::setCanonical($current_url);

    // === OpenGraph Tags ===
    SEOTools::opengraph()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->addImage([
            'url' => $meta_image,
            'width' => 300,
            'height' => 80
        ])
        ->setSiteName($site_name)
        ->addProperty('type', 'website'); // ✅ Use 'website' for Contact page

    // === Twitter Tags ===
    SEOTools::twitter()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->setImage($meta_image)
        ->setSite($twitter_handle);

    // === JSON-LD Schema.org Markup ===
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "ContactPage",
        "name" => $meta_title,
        "description" => $meta_desc,
        "url" => $current_url,
        "inLanguage" => "en-US",
        "dateModified" => now()->toIso8601String(),
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => $current_url
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => $site_name,
            "logo" => [
                "@type" => "ImageObject",
                "url" => $meta_image,
                "width" => 300,
                "height" => 80
            ]
        ],
        // ✅ This is your contact form schema
        "potentialAction" => [
            "@type" => "CommunicateAction",
            "name" => "Contact Form Submission",
            "target" => [
                "@type" => "EntryPoint",
                "urlTemplate" => $current_url . "#contact-form", // adjust ID if needed
                "inLanguage" => "en-US",
                "actionPlatform" => [
                    "http://schema.org/DesktopWebPlatform",
                    "http://schema.org/MobileWebPlatform"
                ]
            ]
        ]
    ];

    $schemaMarkup = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    return view('frontend.contact-us', compact('page', 'setting', 'schemaMarkup'));
}

/*
|--------------------------------------------------------------------------
| About Us
|--------------------------------------------------------------------------
*/

public function about()
{

    $page = Page::where('slug', 'about-us')->firstOrFail();
    $setting = WebSetting::first();

    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    $meta_title = $page->page_name ?? "$site_name - About Us";
    $meta_desc = $page->meta_desc ?? "Learn more about $site_name — our mission, team, and values.";
    $meta_image = asset('storage/settings/' . ($setting->site_logo ?? 'logo.png'));
    $current_url = url()->current();
    // === SEO Meta Tags ===
    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    // === OpenGraph Tags ===
    SEOTools::opengraph()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->addImage($meta_image)
        ->setSiteName($site_name)
        ->addProperty('type', 'website'); // or "AboutPage" if more suitable

    // === Twitter Cards ===
    SEOTools::twitter()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->setImage($meta_image)
        ->setSite('@' . str_replace(' ', '', $site_name)); // Make sure your brand has a real Twitter handle

    // === Schema.org JSON-LD (AboutPage) ===
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "AboutPage",
        "name" => $meta_title,
        "description" => $meta_desc,
        "url" => $current_url,
        "inLanguage" => "en-US",
        "datePublished" => "2025-04-14T08:50:45+00:00", // Optional: Set if known
        "dateModified" => now()->toIso8601String(), // dynamically sets modified date
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => $current_url
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => $site_name,
            "logo" => [
                "@type" => "ImageObject",
                "url" => $meta_image,
                "width" => 300,
                "height" => 80
            ]
        ]
    ];

    $schemaMarkup = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    return view('frontend.about-us', compact('page', 'setting', 'schemaMarkup'));
}

/*
|--------------------------------------------------------------------------
| Terms Conditions
|--------------------------------------------------------------------------
*/

public function termsconditions(Request $request)
{
    $page = Page::where('slug', 'terms-and-conditions')->first();
    $setting = WebSetting::first();

    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    $meta_title = $page->page_name ?? "$site_name - Terms & Conditions";
    $meta_desc = $page->meta_desc ?? "Review the terms and conditions of using $site_name, including user obligations and legal rights.";
    $meta_image = asset('storage/settings/' . ($setting->site_logo ?? 'logo.png'));
    $twitter_handle = $setting->site_twitter ?? '@YourSiteHandle'; // <- Adjust manually

    // === SEO Meta Tags ===
    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    SEOTools::setCanonical(url()->current());
    // === OpenGraph Meta ===
    SEOTools::opengraph()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl(url()->current())
        ->setType('website')
        ->addImage($meta_image)
        ->setSiteName($site_name);

    // === Twitter Cards ===
    SEOTools::twitter()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl(url()->current())
        ->setImage($meta_image)
        ->setSite($twitter_handle);

    // === Schema.org WebPage (Main) ===
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "WebPage",
        "name" => $meta_title,
        "description" => $meta_desc,
        "url" => url()->current(),
        "inLanguage" => "en-US",
        "datePublished" => optional($page->created_at)->toIso8601String(),
        "dateModified" => optional($page->updated_at)->toIso8601String(),
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => url()->current()
        ]
    ];

    $schemaMarkup = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    // === Schema.org WebPage (CreativeWork Extension) ===
    $webPageSchema = [
        "@context" => "https://schema.org",
        "@type" => "CreativeWork",
        "name" => "Terms and Conditions",
        "description" => "This page explains the terms and conditions for using $site_name, including your rights and responsibilities.",
        "inLanguage" => "en-US",
        "url" => url()->current()
    ];
    $webPageSchemaMarkup = json_encode($webPageSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    // === Schema.org Organization Logo ===
    $organizationSchema = [
        "@context" => "https://schema.org",
        "@type" => "Organization",
        "name" => $site_name,
        "url" => url('/'),
        "logo" => [
            "@type" => "ImageObject",
            "url" => $meta_image,
            "width" => 300,
            "height" => 80
        ]
    ];
    $organizationSchemaMarkup = json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    // === Schema.org BreadcrumbList ===
    $breadcrumbs = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => [
            [
                "@type" => "ListItem",
                "position" => 1,
                "name" => "Home",
                "item" => url('/')
            ],
            [
                "@type" => "ListItem",
                "position" => 2,
                "name" => "Terms & Conditions",
                "item" => url()->current()
            ]
        ]
    ];
    $breadcrumbsMarkup = json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    return view('frontend.terms-and-conditions', compact(
        'page',
        'setting',
        'schemaMarkup',
        'webPageSchemaMarkup',
        'organizationSchemaMarkup',
        'breadcrumbsMarkup'
    ));
}

/*
|--------------------------------------------------------------------------
| Privacy Policy
|--------------------------------------------------------------------------
*/

public function privacy(Request $request)
{
    $page = Page::where('slug', 'privacy-policy')->firstOrFail();
    $setting = WebSetting::first();

    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    $meta_title = $page->page_name ?? "$site_name - Privacy Policy";
    $meta_desc = $page->meta_desc ?? "Read the privacy policy of $site_name to understand how we collect, use, store, and protect your data.";
    $meta_image = asset('storage/settings/' . ($setting->site_logo ?? 'logo.png'));
    $current_url = url()->current();
    $twitter_handle = '@EstateGuideBlog'; // ✅ Replace with actual if available

    // === SEO Meta Tags ===
    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    SEOTools::setCanonical($current_url);

    // === OpenGraph Tags ===
    SEOTools::opengraph()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->addImage([
            'url' => $meta_image,
            'width' => 300,
            'height' => 80
        ])
        ->setSiteName($site_name)
        ->addProperty('type', 'WebPage');

    // === Twitter Card Tags ===
    SEOTools::twitter()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->setImage($meta_image)
        ->setSite($twitter_handle);

    // === JSON-LD Schema.org Markup ===
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "WebPage",
        "name" => $meta_title,
        "description" => $meta_desc,
        "url" => $current_url,
        "inLanguage" => "en-US",
        "dateModified" => now()->toIso8601String(),
        "mainEntity" => [
            "@type" => "CreativeWork",
            "name" => "Privacy Policy",
            "description" => "This page outlines how $site_name collects, uses, stores, and protects user data in compliance with data protection laws."
        ],
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => $current_url
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => $site_name,
            "logo" => [
                "@type" => "ImageObject",
                "url" => $meta_image,
                "width" => 300,
                "height" => 80
            ]
        ]
    ];

    $schemaMarkup = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    return view('frontend.privacy-policy', compact('page', 'setting', 'schemaMarkup'));
}

/*
|--------------------------------------------------------------------------
| Disclaimer
|--------------------------------------------------------------------------
*/

public function disclaimer()
{
    $page = Page::where('slug', 'disclaimer')->firstOrFail();
    $setting = WebSetting::first();

    $site_name = config('seotools.opengraph.defaults.site_name', config('app.name'));
    $meta_title = $page->page_name ?? "$site_name - Disclaimer";
    $meta_desc = $page->meta_desc ?? "Read the disclaimer of $site_name covering content usage, accuracy, and liability limits.";
    $meta_image = asset('storage/settings/' . ($setting->site_logo ?? 'logo.png'));
    $current_url = url()->current();

    // === SEO Meta Tags ===
    // SEOTools::setTitle($meta_title);
    SEOTools::setDescription($meta_desc);
    SEOTools::setCanonical($current_url);

    // === Open Graph ===
    SEOTools::opengraph()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->addImage($meta_image)
        ->setSiteName($site_name)
        ->addProperty('type', 'WebPage');

    // === Twitter Card ===
    SEOTools::twitter()
        ->setTitle($meta_title)
        ->setDescription($meta_desc)
        ->setUrl($current_url)
        ->setImage($meta_image)
        ->setSite('@' . preg_replace('/\s+/', '', $site_name));

    // === JSON-LD Schema ===
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "WebPage",
        "name" => $meta_title,
        "description" => $meta_desc,
        "url" => $current_url,
        "inLanguage" => "en-US",
        "datePublished" => optional($page->created_at)->toIso8601String(),
        "dateModified" => optional($page->updated_at)->toIso8601String(),
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => $current_url
        ],
        "about" => [
            "@type" => "Thing",
            "name" => "Website Disclaimer Policy"
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => $site_name,
            "logo" => [
                "@type" => "ImageObject",
                "url" => $meta_image,
                "width" => 300,
                "height" => 80
            ]
        ]
    ];

    $schemaMarkup = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    return view('frontend.discalimer', compact('page', 'setting', 'schemaMarkup'));
}

/*
|--------------------------------------------------------------------------
| Error 404
|--------------------------------------------------------------------------
*/

public function error(Request $request)
{
    $page = Page::where('slug', '404')->first();
    $setting = WebSetting::first();
    return view('frontend.404', compact('page', 'setting'));
}

}
