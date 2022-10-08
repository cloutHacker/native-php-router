<?php


use Illuminate\Support\Helpers\Objects\SplashObject;
use Illuminate\Support\Router\RouterHelper;
use Illuminate\Support\Router\RouterHelper;

     /**
     * @return App\Console\Controller
     */
    function view(string $view, $props = [])
    {
        foreach ($props as $key => $value) {
            $$key = $value;
        }
        //still open for modification
        $view = RouterHelper::cleanViewPath($view);
        return RouterHelper::getView($view) ? require RouterHelper::$viewPath . $view :
            die(RouterHelper::throwError('', 'Error View not found'));
    }