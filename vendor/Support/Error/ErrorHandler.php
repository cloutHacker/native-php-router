<?php

namespace Illuminate\Support\Error;

use ErrorException;
use Exception;

trait ErrorHandler
{
    /**
     * @param int $code
     * @param string $error
     */
    protected static function throwError($code = '', $error) {
        //sets the variables accessed on the error view file
        $title = $code.' '.$error;
        //Includes the error view file
        $file = __DIR__.'./errorView/Notfound.php';
        //Includes the file in the relative path
        require_once $file;

    }
    
}
