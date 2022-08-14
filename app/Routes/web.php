<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Support\Router\Router;

$router  = new Router();
$router->get('/kemboi/home', [UserController::class, 'index']);
$router->view('home', 'home');
$router->post('/derick', [UserController::class, 'derick']);
$router->run();


