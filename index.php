<?php

/*
 |starting a new instance of the app
 |This is a copyright © software owned by codeSplash 
 | Thanks to developer Kibiwott currently studying at Alliance High School
 */

//This is to automatically autoload all the classes
 include __DIR__.'/vendor/autoload.php';

 use Illuminate\Support\Router\Router;

 
include './bootstrap/app.php';

//including all the routes in the web
include __DIR__.'/app/Routes/web.php';

/*
 |Running the app to start the router and all the required functionality
 |This starts the all app
 */
Router::run();
