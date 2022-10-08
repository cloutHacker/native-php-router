<?php
namespace Illuminate\Support\Interfaces;

interface RouterInterface {
    public function exec($requestUri, $requestPath);
}