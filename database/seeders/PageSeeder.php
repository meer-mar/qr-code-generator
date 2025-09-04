<?php

namespace Database\Seeders;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Page::truncate();
        $pages = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'meta_desc' => 'Welcome to our website. Explore our services and products.',
                'page_name' => 'Home',
                'page_desc' => 'This is the home page of the website.',
                'status' => 1,
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'meta_desc' => 'Get in touch with us for any inquiries or support.',
                'page_name' => 'Contact Us',
                'page_desc' => 'This is the contact us page. Reach out to us with any queries.',
                'status' => 1,
            ],
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'meta_desc' => 'Get in touch with us for any inquiries or support.',
                'page_name' => 'About Us',
                'page_desc' => 'This is the About us page. Reach out to us with any queries.',
                'status' => 1,
            ],
            [
                'title' => 'Terms and Conditions',
                'slug' => 'terms-and-conditions',
                'meta_desc' => 'Read the terms and conditions of using our website.',
                'page_name' => 'Terms and Conditions',
                'page_desc' => 'These are the terms and conditions for using our website.',
                'status' => 1,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'meta_desc' => 'Learn how we protect your privacy and personal information.',
                'page_name' => 'Privacy Policy',
                'page_desc' => 'This is our privacy policy.',
                'status' => 1,
            ],
            [
                'title' => 'Sign In',
                'slug' => 'sign-in',
                'meta_desc' => 'Sign in to access your account.',
                'page_name' => 'Sign In',
                'page_desc' => 'This is the sign-in page for users to access their accounts.',
                'status' => 1,
            ],
            [
                'title' => 'Sign Up',
                'slug' => 'sign-up',
                'meta_desc' => 'Create a new account with us.',
                'page_name' => 'Sign Up',
                'page_desc' => 'This is the sign-up page for new users.',
                'status' => 1,
            ],
            [
                'title' => 'Blog Show',
                'slug' => 'blogshow',
                'meta_desc' => 'Explore blog posts and articles.',
                'page_name' => 'Blog Show',
                'page_desc' => 'This page displays individual blog posts.',
                'status' => 1,
            ],
            [
                'title' => 'Blog List',
                'slug' => 'blog-listing',
                'meta_desc' => 'Browse through a list of all blog posts.',
                'page_name' => 'Blog List',
                'page_desc' => 'This page displays a list of all blog posts.',
                'status' => 1,
            ],
            [
                'title' => 'Blog Show',
                'slug' => 'blog-show',
                'meta_desc' => 'Browse through a list of all blog posts.',
                'page_name' => 'Blog Show',
                'page_desc' => 'This page displays a list of all blog posts.',
                'status' => 1,
            ],
            [
                'title' => 'Blog Categories',
                'slug' => 'categories-listing',
                'meta_desc' => 'Browse through a list of all blog posts.',
                'page_name' => 'Categories List',
                'page_desc' => 'This page displays a list of all blog posts.',
                'status' => 1,
            ],
        ];

        // Loop through the pages and insert them
        foreach ($pages as $page) {
            DB::table('pages')->insert([
                'title' => $page['title'],
                'slug' => $page['slug'],
                'meta_desc' => $page['meta_desc'],
                'page_name' => $page['page_name'],
                'page_desc' => $page['page_desc'],
                'status' => $page['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
