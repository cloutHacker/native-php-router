<?php

namespace Illuminate\Support\Router\RouterKernel;

use Illuminate\Support\Router\RouterHelper;

trait GetRouter
{
    use RouterHelper;
    private static array $getHandler = [];
    private static $METHOD_GET = 'GET';

    public static function get(string $path, $handler): void
    {
        $path = self::cleanRequestPath($path);
        self::$getHandler = array_merge(
            self::addHandler(self::$getHandler, self::$METHOD_GET, $path, $handler),
            self::$getHandler
        );
    }
    public static function getexec($requestMethod, $requestPath)
    {   
        $source = self::$getHandler;
        $slugUrl = self::findSlugUrl($source, $requestPath);
        $slugValues = $slugUrl ? self::findSlugValue($slugUrl, $requestPath) : '';
        $valid = self::validateSlugRoute($slugUrl, $requestPath) || self::validateRoute($source,self::$METHOD_GET,$requestMethod,$requestPath);
        $slugHandler = self::findSlugHandler($requestMethod, $slugUrl);
        $callback =  $slugHandler ? $slugHandler :
         @self::$getHandler[self::$METHOD_GET.$requestPath]['handler'];
        return $valid ? self::runRoute($callback, $slugValues) : false;
    }
    /*
     |takes all the arrays an searches for the handler of the slug
     |slug example GET/a/b/abcd
     */
    /**
     * @var array
     * @return string|object
     */
    public static function findSlugHandler($requestMethod,$slug) {
       $key = $requestMethod.$slug;
       return @self::$getHandler[$key]['handler'];
    }

}
