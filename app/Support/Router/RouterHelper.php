<?php

namespace App\Support\Router;

use App\Support\Error\ErrorHandler;

class RouterHelper
{
    use ErrorHandler;
    protected function cleanViewPath(string $path){
        $path = preg_replace('#.php#', '', $path);
        $parts = explode('.', $path);
        $last = $parts[count($parts) - 1];
        if (!@explode('.', $last)[1]) {
            $path = str_replace('.', '/', $path);
            $path = $path.'.php';
        }
        return $path;
    } 
    protected function cleanRequestPath(string $path):string {
            if (!preg_match('!^/(.*)!', $path)) 
            {
                $path = '/'.$path;
            }
            return $path;
    }
    protected function cleanRouterHandler($handler) {
        $conj = $handler;
       if (is_array($handler)) {
        $class = $handler[0];
        $func = $handler[1];
        $conj = $class.'::'.$func;
    }
    return $conj;
    }
    protected function renderView($handler) {
        $dir = __DIR__ . './../../Views/'. $handler['handler'];
        if (file_exists($dir)) {
            $callback = require_once $dir;
            return $callback;
        } 
        $this->throwError('','Error view not found');
    }
}
