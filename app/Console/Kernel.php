<?php
namespace App\Console;

use Illuminate\Support\Command\SplashCode;
use Illuminate\Support\Core\ConsoleKernel;

class Kernel extends ConsoleKernel
{
    use SplashCode;
    public $path = __DIR__.'/../Http/Controllers/';
    public $viewPath;
}