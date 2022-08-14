<?php

namespace App\Support\Router;

use App\Support\Error\ErrorHandler;
use App\Support\Interfaces\RouterInterface;
use App\Support\Router\RouterHelper;

class Router extends RouterHelper implements RouterInterface
{
    use ErrorHandler;
    private array $handlers;
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';
    private $pageNotFound;
    private $viewFound;

    public function get(string $path, $handler): void
    {
        $path = $this->cleanRequestPath($path);
        $this->addHandler(self::METHOD_GET, $path, $handler);
    }
    public function post(string $path, $handler): void
    {
        $path = $this->cleanRequestPath($path);
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }
    public function view(string $path, $view)
    {
        #incase the the person used dots or ommited a dot
        $view = $this->cleanViewPath($view);
        $path = $this->cleanRequestPath($path);
        $this->addHandler('View', $path, $view);
    }
    private function addHandler(string $method, string $path, $handler)
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }
    public function addNotFoundHandler($handler)
    {
        call_user_func($handler);
    }
    public function run()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];
        $callback = false;
        $key = $method . $requestPath;
        //checking if the route exists
        if (@$handler = $this->handlers[$key]) {
            if ($handler['path'] === $requestPath && $method == $handler['method']) {
                $callback = $handler['handler'];
            }
            //checking if the method is view
        } elseif (@$handler = $this->handlers['View' . $requestPath]) {
            return $this->renderView($handler);
        }
        //checking if the method is view
        elseif ($method == 'GET' && @$handler = $this->handlers['POST'.$requestPath]){
           $this->throwError('','Error method not allowed');
        } 
        else {
            $this->addNotFoundHandler(function () {
                $this->throwError('', 'Error Page not found');
            });
        }
        if (is_object($callback)) {
            call_user_func_array($callback, [
                array_merge($_GET, $_POST)
            ]);
        } elseif (is_array($callback)) {
            $class = new $callback[0]();
            $func = $callback[1];
            $class->$func();
        }
    }
}
