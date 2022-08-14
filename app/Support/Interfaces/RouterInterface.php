<?php
namespace App\Support\Interfaces;

interface RouterInterface {
    public function run();
    public function get(string $path, $handler);
    public function post(string $path, $handler);
    public function addNotFoundHandler($handler);
    public function view(string $path, $view);
}