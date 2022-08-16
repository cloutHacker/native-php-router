<?php

namespace Illuminate\Support\Command;


trait SplashCode
{
    public $controllerPath = __DIR__ .'./../app/Http/Controllers';
    public array $command = [];
    public function controllerContent($controller)
    {
        $content = '<?php
namespace App\Http\Controllers;
        
 use App\Http\Controllers\Controller;
        
 class ' . $controller . ' extends Controller{
            //
}';
        return $content;
    }
    public function genController($dir, $controller)
    {
        if ($this->validateController($dir, $controller)) {
        $contents = $this->controllerContent($controller);
        file_put_contents($dir.$controller.'.php', $contents);
        }
    }
    
    public function validateController($dir,$controller)
    {
        if (file_exists($dir.$controller . '.php')) {
            echo "controller already exists";
            return false;
        }
        return true;
    }
    
}
