<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Router\Router;

Router::get('/home/{name}/title/{title}', [UserController::class, 'index']);
Router::get('/noe', function () {
    echo "name derick kibiwot";
});
Router::view('/', function () {
    return 't';
});
Router::view('/rutto', function () {
    return 'rutto';
});


