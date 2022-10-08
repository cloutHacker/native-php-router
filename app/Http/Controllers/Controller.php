<?php

namespace App\Http\Controllers;

use Illuminate\Support\Error\ErrorHandler;
use Illuminate\Support\Helpers\Objects\SplashObject;
use Illuminate\Support\Router\RouterHelper;

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
     * @return App\Console\Controller
     */
    function view(string $view, $props = [])
    {
        foreach ($props as $key => $value) {
            $$key = $value;
        }
        //still open for modification
        $view = self::cleanViewPath($view);
        return self::getView($view) ? require self::$viewPath . $view :
            die(self::throwError('', 'Error View not found'));
    }
}
