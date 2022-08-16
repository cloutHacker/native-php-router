<?php

namespace Illuminate\Support\Core;
use Illuminate\Support\Interfaces\KernelInterface;

class ConsoleKernel implements KernelInterface {

    /**
     * @var empty
     * @return string
     */
    public function findViewDir()
    {
        $dir = $_ENV['VIEW_PATH'] ?? __DIR__.'./../../../app/Views/';
    }
}