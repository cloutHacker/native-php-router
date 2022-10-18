<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Router\Router;

Router::view('/', 'home');
Router::get("/user/register", [UserController::class, 'register']);
Router::get("/user/login", [UserController::class, 'login']);



