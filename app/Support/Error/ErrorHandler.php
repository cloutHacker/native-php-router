<?php

namespace App\Support\Error;

trait ErrorHandler
{
    protected function throwError($code = '', $error) {
        $title = $code.' '.$error;
        $file = __DIR__.'./errorView/Notfound.php';
        require_once $file;
    }
}
