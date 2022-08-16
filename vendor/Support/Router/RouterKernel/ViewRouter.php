<?php

namespace Illuminate\Support\Router\RouterKernel;
use Illuminate\Support\Router\RouterHelper;

trait ViewRouter
{   
    use RouterHelper;

    private static array $viewHandler = [];
    private static $METHOD_VIEW = 'GET';
    public static function view(string $path, $handler): void
    {
        $path = self::cleanRequestPath($path);
        self::$viewHandler = array_merge(
            self::addHandler(self::$viewHandler, self::$METHOD_VIEW, $path, $handler),
            self::$viewHandler
        );
    }
    public static function viewExec($requestUri, $requestPath)
    {
        //validates the url if it exists or not
       $valid = self::validateRoute(self::$viewHandler,self::$METHOD_VIEW,$requestUri, $requestPath);
       $callback = @self::$viewHandler[self::$METHOD_VIEW.$requestPath]['handler'];
        return $valid ? self::renderView($callback) : false;
    }
    

}
