const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('tailwindcss'),
   ])
   .sourceMaps();

// Configuración para recarga automática
mix.browserSync({
    proxy: '127.0.0.1:8000',
    files: [
        'resources/views/**/*.blade.php',
        'resources/css/**/*.css',
        'resources/js/**/*.js',
    ],
});
