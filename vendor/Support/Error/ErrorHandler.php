<?php

namespace Illuminate\Support\Error;

use ErrorException;
use Exception;

trait ErrorHandler
{
    protected static function throwError($code = '', $error) {
        $title = $code.' '.$error;
        $file = __DIR__.'./errorView/Notfound.php';
        require_once $file;
    }
}
