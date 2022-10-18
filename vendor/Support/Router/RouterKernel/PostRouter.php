<?php

namespace Illuminate\Support\Router\RouterKernel;

use Illuminate\Support\Helpers\Request\RequestHandler;

use Illuminate\Support\Router\RouterHelper;

trait PostRouter
{   
    use RouterHelper;

    private static array $postHandler = [];
    private static  $METHOD_POST = 'POST';
    public static function post(string $path, $handler): void
    {
        $path = self::cleanRequestPath($path);
        self::$postHandler = array_merge(
            self::addHandler(self::$postHandler, self::$METHOD_POST, $path, $handler),
            self::$postHandler
        );
    }
    public static function postExec($requestUri, $requestPath)
    {
       $valid = self::validateRoute(self::$postHandler,self::$METHOD_POST,$requestUri, $requestPath);
       $callback = @self::$postHandler[self::$METHOD_POST.$requestPath]['handler'];
        return $valid ? self::runRoute($callback, [new RequestHandler()]) : false;
    }

}
