<?php

namespace Illuminate\Support\Router\RouterKernel;

use Illuminate\Support\Helpers\Request\RequestHandler;
use Illuminate\Support\Router\RouterHelper;

trait PutRouter
{   
    use RouterHelper;

    private static array $putHandler = [];
    private static  $METHOD_PUT= 'PUT';
    public static function put(string $path, $handler): void
    {
        $path = self::cleanRequestPath($path);
        self::$putHandler = array_merge(
            self::addHandler(self::$putHandler, self::$METHOD_PUT, $path, $handler),
            self::$putHandler
        );
    }
    public static function putExec($requestUri, $requestPath)
    {
       $valid = self::validateRoute(self::$putHandler,self::$METHOD_PUT,$requestUri, $requestPath);
       $callback = @self::$putHandler[self::$METHOD_PUT.$requestPath]['handler'];
        return $valid ? self::runRoute($callback, [new RequestHandler()]) : false;
    }

}
