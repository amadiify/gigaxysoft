# Centurion Web Application

## All general documentation would appear here.

Introduction.

```php

    /**
     * @package Centurion Web application
     * @author  Amadi ifeanyi <amadiify.com>
     * This application is developed with the Moorexa open source PHP framework, developed and managed by Fregate Software Lab.
    */
```

The main controller for public view lives in 'pages/App'. A controller can be generated via the terminal with 

```bash

   php assist new page < page Name >
```

All static files have been autoloaded in 'kernel/loadStatic.json'. Before production, we would bundle all static files and serve them from a CDN. 

```json

    {
    "stylesheet": [
        "https://fonts.googleapis.com/css?family=Open+Sans:400,600,700",
        "https://fonts.googleapis.com/css?family=Roboto:300,400,700",
        "moorexa.css",
        "fontawesome.min.css",
        "theme/bootstrap.css",
        "theme/styles.css"
    ],

    "stylesheet@bundle" : [
        
    ],
    
    "scripts": [
        "moorexa.min.js",
        "theme/jquery.js",
        "theme/moment.js",
        "theme/bootstrap.js",
        "theme/owl-carousel.js",
        "theme/blur-area.js",
        "theme/icheck.js",
        "theme/gmap.js",
        "theme/magnific-popup.js",
        "theme/ion-range-slider.js",
        "theme/sticky-kit.js",
        "theme/smooth-scroll.js",
        "theme/fotorama.js",
        "theme/bs-datepicker.js",
        "theme/typeahead.js",
        "theme/quantity-selector.js",
        "theme/countdown.js",
        "theme/window-scroll-action.js",
        "theme/fitvid.js",
        "theme/youtube-bg.js",
        "theme/custom.js"
    ],

    "scripts@bundle" : [
         
    ]
}
```

All static files, general assets are cached in 'public/Assets/assets.paths.json' and served at zero seconds.

# Landing page
You can start the development server by running:

```bash
    php assist serve
```

See example landing screen.
![Landing Page]("https://github.com/amadiify/centurion/blob/master/pages/App/Static/images/promo/First-preview.png")

