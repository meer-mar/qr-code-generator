const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .js(
        [
            "node_modules/overlayscrollbars/js/jquery.overlayScrollbars.min.js",
            "node_modules/jquery-mousewheel/jquery.mousewheel.js",
            "node_modules/raphael/raphael.js",
            "node_modules/chart.js/dist/chart.js",
        ],
        "public/js/vendor.js"
    )
    .js(
        ["resources/js/demo.js", "resources/js/dashboard2.js"],
        "public/js/demo.js"
    )
    .sass("resources/sass/app.scss", "public/css")
    .sourceMaps();
