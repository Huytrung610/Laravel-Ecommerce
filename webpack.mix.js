const mix = require('laravel-mix');

mix.js("resources/js/app.js", "public/js")
   .postCss("resources/css/app.css", "public/css", [
       require("tailwindcss"),
       require("postcss-import"),
   ])
   .js('resources/js/frontend/newsletter.js', 'public/js/frontend')
   .js('resources/js/frontend/checkout.js', 'public/js/frontend')
   .js('resources/js/backend/newsletter.js', 'public/js/backend')
   .js('resources/js/backend/product.js', 'public/js/backend')
   .sass('resources/sass/app.scss', 'public/css')
   .copy('node_modules/select2/dist/js/select2.min.js', 'public/js')
   .copy('node_modules/select2/dist/css/select2.min.css', 'public/css')
   .js('resources/js/backend/brand.js', 'public/js/backend')
   .js('resources/js/backend/user.js', 'public/js/backend')
   .js('resources/js/backend/dashboard.js', 'public/js/backend')
   .js('resources/js/backend/banner.js', 'public/js/backend')
   .js('resources/js/backend/finder.js', 'public/js/backend')
   .js('resources/js/frontend/banner.js', 'public/js/frontend')
   .js('resources/js/frontend/product-detail.js', 'public/js/frontend')
   .js('resources/js/frontend/member.js', 'public/js/frontend')
mix.sass('resources/sass/product-detail.scss', 'public/css')
    .sass('resources/sass/checkout.scss', 'public/css')
    .sass('resources/sass/member-setting.scss', 'public/css')