const mix = require('laravel-mix');


mix.js([
    'node_modules/moment/moment.js',
    'node_modules/sweetalert2/dist/sweetalert2.min.js',
    'src/resources/assets/js/index.js'
], 'src/resources/assets/main.js');