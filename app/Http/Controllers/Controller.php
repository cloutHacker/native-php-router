<?php

namespace App\Http\Controllers;

use Illuminate\Support\Error\ErrorHandler;
use Illuminate\Support\Router\RouterHelper;
use Illuminate\Support\Helpers\Objects\SplashObject;

class Controller extends SplashObject
{
    use RouterHelper;
    /**
     * @var string
     * @return void
     * 
     */
    use ErrorHandler;
    /**
     * calls the views if there is no one it throws a view error
     * @param string $view
     * @param array $props
     * @return App\Console\Controller
     */
    function view(string $view, $props = [])
    {
        //assigning the functions of the prop
        foreach ($props as $key => $value) {
            $$key = $value;
        }
        //still open for modification
        $view = self::cleanViewPath($view);
        return self::getView($view) ? require self::$viewPath . $view :
            die(self::throwError('', 'Error View not found'));
    }
}
