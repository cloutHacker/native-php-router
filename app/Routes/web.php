<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Router\Router;

Router::view('register', 'user.register');

Router::post('register/user', [UserController::class, 'register']);

Router::get('home/name/{name}/title/{title}', [UserController::class, 'home']);


