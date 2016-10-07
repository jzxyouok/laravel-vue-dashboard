//process.env.DISABLE_NOTIFIER = true;

var jQuery, $ = require('jquery');

// require('bootstrap');

// require('fullcalendar');

var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

elixir(function(mix) {
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts');
    mix.copy('resources/assets/css/libs/onlinewebfonts/fonts', 'public/fonts');
    mix.copy('node_modules/bootstrap-sass/assets/fonts', 'public/fonts');
    mix.browserify('monitor-app.js');
    mix.browserify('dashboard-app.js')
        .styles([
            './node_modules/normalize.css/normalize.css',
            './node_modules/nprogress/nprogress.css',
            './node_modules/loaders.css/loaders.css',
            './node_modules/bootstrap-daterangepicker/daterangepicker.css',
            './node_modules/sweetalert/dist/sweetalert.css',
        ]);
    mix.sass('monitor-app.scss')
        .styles([
            'libs/onlinewebfonts/onlinewebfonts.css',
        ])
        .scripts([
        ]);
    
    mix.sass('dashboard-app.scss')
        .styles([
            'libs/onlinewebfonts/onlinewebfonts.css',
            'libs/sweetalert/sweetalert.css'
        ])
        .scripts([
            'libs/sweetalert/sweetalert-dev.js',
            // 'libs/fullcalendar/fullcalendar.js'
        ]);
    //mix.version(['js/app.js', 'css/app.css', 'css/all.css']);
});

/*elixir(function(mix) {
    mix.sass('app.scss')
       .scripts([
            'libs/sweetalert-dev.js',
            'libs/lity.js'
        ], './public/js/libs.js')
       .styles([
            'libs/sweetalert.css',
            'libs/lity.css'
        ], './public/css/libs.css');
});*/