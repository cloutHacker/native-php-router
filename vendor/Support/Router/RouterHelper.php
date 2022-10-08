<?php

namespace Illuminate\Support\Router;

use Illuminate\Support\Error\ErrorHandler;

trait RouterHelper
{
    use ErrorHandler;
    private static $viewPath = __DIR__ . './../../../app/Views/';
    private static $allowedSlugs = '-_/?';
    /*
    |cleans path removing dots and returning correct path
    |eg templates.nav to templates/nav.php
    */
    protected static function cleanViewPath(string $path)
    {
        $path = preg_replace('#.php#', '', $path);
        $parts = explode('.', $path);
        $last = $parts[count($parts) - 1];
        if (!@explode('.', $last)[1]) {
            $path = str_replace('.', '/', $path);
            $path = $path . '.php';
        }
        return $path;
    }
    /*
    |returns if the view is found
    */
    /**
     * @var string
     * @return bool
     */
    private static function getView($view)
    {
        $dir = self::$viewPath . $view;
        return file_exists($dir);
    }
    /*
    |returns an rerror if the view is not found
    */
    private static function returnView($view)
    {
        //removing dots and validating if the route exists
        $view = self::cleanViewPath($view);
        return self::getView($view) ? require self::$viewPath . $view :
            self::throwError('', 'Error View not found');
    }
    protected static function cleanRequestPath(string $path): string
    {
        $path = !preg_match('!^/(.*)!', $path) ? '/' . $path : $path;
        return $path;
    }
    /*
    |validate if the views are found using the view path
    |
    */
    /**
     * @return void
     */
    protected static function renderView($view, array $props = [])
    {   //check if the view is string

        $view = is_string($view) ? $view : call_user_func($view);
        self::returnView($view);
        //Inorder not to render an error page for the user
        return true;
    }
    protected static function cleanPath($path)
    {
        require_once __DIR__ . './../../../bootstrap/app.php';
        $path = BASE_URL;
        return $path;
    }
    protected static function validateViewPath($path)
    {
        if (is_string($path)) {
            $path =  self::cleanViewPath($path);
        }
        return $path;
    }
    /**
     * @return array
     */
    protected static function addHandler(array $source, string $method, string $path, $handler): array
    {
        $source[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
        return $source;
    }
    /**
     * @var array
     * @return bool
     */
    protected static function validateRoute($source, $method, $requestMethod, $requestPath): bool
    {
        $key = $method . $requestPath;
        if ($method !== $requestMethod && key_exists($key, $source)) {
            self::throwError('', 'Error Method not allowed');
        } elseif ($method == $requestMethod && key_exists($key, $source)) {
            return true;
        }
        return false;
    }
    /*
     |runs the function where the class and its object are provided in an array
     | 
     */
    /**
     * @return object
     * @param object $callback
     * @param array $args
     */
    public static function runClass($callback, $args = [])
    {
        $class = @new $callback[0]();
        $func = @$callback[1];
        return method_exists($class, $func) ? call_user_func_array([$class, $func], $args) : self::throwError('', 'Undefined Class or method');
    }
    /*
    |calls the route even thought it is a array
    |
    */

    public static function runRoute($callback, $slugValues = [])
    {
        is_object($callback) ? call_user_func_array($callback, $slugValues) : self::runClass($callback, $slugValues);
        return true;
    }
    /*
     |throws errors incase all the routes were not found
     | 
     */
    public static function validateErrors(array $routes)
    {
        return self::allFalse($routes) ?
            self::throwError('', 'Error page not found') : '';
    }
    /**
     * @param array $array
     * returns true if all values of an array are false
     */
    public static function allFalse(array $array)
    {
        $arrayCount = count($array);
        $counter = 0;
        foreach ($array as $item) {
            $counter = !$item ? $counter + 1 : $counter;
        }
        return $counter == $arrayCount ? true : false;
    }
    /**
     * @return bool
     */
    public static function hasSlug(string $route): bool
    {
        $hasSlug = preg_match("#{\w+}#", $route) ? true : false;
        return $hasSlug ? true : false;
    }
    /*
     |takes a source and array
     |matches eg = /kemboi/home/{id}/pp/{class}
     |takes a request path eg = /kemboi/home/dd/pp/c 
     */
    public static function findSlugUrl($source, $requestPath)
    {
        foreach ($source as $item) {
            $path = $item['path'];
            $newPath = preg_replace("#{.*?}#", "\w+[" . self::$allowedSlugs . "]?\w+", $path);
            preg_match("#$newPath#", $requestPath, $match);
            if (@$match[0] === $requestPath) {
                return $path;
            }
        }
        return false;
    }
    /*
     |returns text seperated by a comma for the arguments of the function
     | 
     */
    /**
     * @var array
     * @return string
     */
    public static function findSlugValue($slug, $requestPath): array
    {
        $val = [];
        $slug = preg_replace("#{.*?}#", '{}', $slug);
        $slug = explode('/', $slug);
        $requestPaths = explode('/', $requestPath);
        for ($i = 0; $i < count($slug); $i++) {
            $val[] = $slug[$i] == '{}' ? $requestPaths[$i] : '';
        }
        return array_filter($val, function ($val) {
            return $val !== '' ? $val : '';
        });
    }
    /*
     |request path = /kemboi/home/dd/pp/c
     |slugPath = /kemboi/home/{id}/pp/{class} 
     */
    public static function validateSlugRoute($slugPath, $requestPath): bool
    {
        $slugPath = preg_replace("#{.*}#", '{}', $slugPath);
        $slug = self::findSlugValue($slugPath, $requestPath);
        return $slug !== [] ? true : false;
    }

    /*
    |end of the class
     */
}
