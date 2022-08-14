<?php

namespace App\Http\Controllers;

use App\Support\Error\ErrorHandler;
use App\Support\Router\RouterHelper;

class Controller extends RouterHelper{
    /**
     * @var string
     * @return void
     * 
     */
    use ErrorHandler;
    public function view(string $file):void {
        $filtered_path = $this->cleanViewPath($file);
        $dir = __DIR__.'./../../Views/'.$filtered_path;
        if (file_exists($dir)) {
            require_once $dir;
        }else {
            $this->throwError('','Error view not found');
        }
    }
}