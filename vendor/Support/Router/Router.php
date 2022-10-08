<?php

namespace Illuminate\Support\Router;
use Illuminate\Support\Router\RouterKernel\GetRouter;
use Illuminate\Support\Router\RouterKernel\PostRouter;
use Illuminate\Support\Router\RouterKernel\PutRouter;
use Illuminate\Support\Router\RouterKernel\ViewRouter;

class Router
{   
    use RouterHelper;
    use GetRouter;
    use PostRouter;
    use ViewRouter;
    use PutRouter;
    public static function run()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestPath = '/'.self::cleanPath($requestPath);
        $post = self::postExec($requestMethod, $requestPath);
        $get = self::getexec($requestMethod, $requestPath);
        $view  = self::viewExec($requestMethod, $requestPath);
        $put = self::putExec($requestMethod, $requestPath);
       return  self::validateErrors([$get,$post,$view,$put]);
    }
}
