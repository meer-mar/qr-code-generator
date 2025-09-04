<?php

/**
 * @see https://github.com/artesaos/seotools
 * SEO configuration optimized for Estate Guide Blog
 */

return [

    // 🔹 Basic Meta Configuration
    'meta' => [
        'defaults' => [
            // 'title'       => 'Estate Guide Blog',         // Default site title
            'titleBefore' => false,                       // Title separator position
            'description' => 'Explore expert articles, real estate insights, property guides, and the latest trends in the Estate Guide Blog.',
            'separator'   => ' | ',                       // Separator for title
            'keywords'    => ['real estate', 'property tips', 'housing market', 'Estate Guide Blog'],
            'canonical'   => 'current',                   // Use current URL as canonical
            'robots'      => 'index, follow',
            'author'      => 'Estate Guide Blog',
            'rating'      => 'General',                   // For parental content rating
        ],

        'webmaster_tags' => [
            'google'    => 'your-google-site-verification-code', // ✅ Replace with your actual code
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],
    ],

    // 🔹 OpenGraph for Facebook, LinkedIn, etc.
    'opengraph' => [
        'defaults' => [
            'title'       => 'Estate Guide Blog',
            'description' => 'Discover real estate news, tips, and property trends with Estate Guide Blog.',
            'url'         => null,                         // Auto-detect current URL
            'type'        => 'website',                    // Default type
            'site_name'   => 'Estate Guide Blog',
            'images'      => [asset('storage/settings/default-og-image.jpg')], // ✅ Replace with your default OG image
        ],
    ],

    // 🔹 Twitter Card Defaults
    'twitter' => [
        'defaults' => [
            'card' => 'summary_large_image',              // Twitter image card type
            'site' => '@EstateGuideBlog',                 // ✅ Replace with your actual Twitter handle
        ],
    ],

    // 🔹 JSON-LD Schema Defaults
    'json-ld' => [
        'defaults' => [
            'title'       => 'Estate Guide Blog',
            'description' => 'Stay up-to-date with property market news, home buying tips, and expert estate guidance.',
            'url'         => null,                         // Auto-use current
            'type'        => 'WebPage',
        ],
    ],
];
