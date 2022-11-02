<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Router\Router;

Router::view('/', 'home');
Router::view("/user/register",'register');
// Router::get("/user/login", [UserController::class, 'login']);



