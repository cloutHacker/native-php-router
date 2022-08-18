<?php

namespace Illuminate\Support\Helpers\Request;

use Illuminate\Support\Error\ErrorHandler;
use Illuminate\Support\Helpers\Objects\SplashObject;
use Illuminate\Support\Interfaces\Validation\Request;
use Illuminate\Support\Validation\Helpers\Validator;

class RequestHandler extends SplashObject implements Request
{
    use ErrorHandler, Validator;
    /**
     * @param object
     * @return string
     * Takes in a object parameter and returns the value of the property being called
     */
    public function __get($name)
    {
        return $this->all()->$name ?? $this->throwError('', 'Call to undefined property');
    }
   
    /**
     * @param null
     * Takes no parameter and returns all the values of the post request as an object
     */
    public function all()
    {
    
        return static::arrToObj($_POST);
    }

}
