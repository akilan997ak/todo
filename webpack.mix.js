const mix = require('laravel-mix');

// Compile the main JavaScript file
mix.js('resources/js/app.js', 'public/js')

// Compile the main CSS file with TailwindCSS
   .postCss('resources/css/app.css', 'public/css', [
       require('tailwindcss'),
   ]);
