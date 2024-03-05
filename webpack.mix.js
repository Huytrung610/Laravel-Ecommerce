const mix = require('laravel-mix');

mix.js("resources/js/app.js", "public/js")
   .postCss("resources/css/app.css", "public/css", [
       require("tailwindcss"),
       require("postcss-import"),
   ])
   .js('resources/js/frontend/newsletter.js', 'public/js/frontend')
   .js('resources/js/backend/newsletter.js', 'public/js/backend')
   .sass('resources/sass/app.scss', 'public/css');