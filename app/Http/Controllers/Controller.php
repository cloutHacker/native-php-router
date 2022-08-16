<?php

namespace App\Http\Controllers;

use Illuminate\Support\Error\ErrorHandler;
use Illuminate\Support\Router\RouterHelper;

class Controller
{
    use RouterHelper;
    /**
     * @var string
     * @return void
     * 
     */
    use ErrorHandler;
    public function view(string $view, $props = [])
    {   
        foreach ($props as $key => $value) {
            $$key = $value;
        }
        //still open for modification
        $view = self::cleanViewPath($view);
        return self::getView($view) ? require self::$viewPath . $view :
            self::throwError('', 'Error View not found');
    }
}
