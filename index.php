<?php
/*
 |starting a new instance of the app
 |This is a copyright© software owned by codeSplash 
 | Thanks to developer Kibiwott currently studying at Alliance High School
 */
 include __DIR__.'/vendor/autoload.php';

 use Illuminate\Support\Router\Router;
include './bootstrap/app.php';

include __DIR__.'/app/Routes/web.php';

/*
 |Running the app to start the router and all the required functionality
 |
 */


Router::run();
