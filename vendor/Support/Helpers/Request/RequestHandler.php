<?php

namespace Illuminate\Support\Helpers\Request;

use Illuminate\Support\Error\ErrorHandler;
use Illuminate\Support\Helpers\Objects\SplashObject;
use Illuminate\Support\Interfaces\Validation\Request;
use Illuminate\Support\Validation\Helpers\RequestHelper;

class RequestHandler extends SplashObject implements Request
{
    //Getting all the function from request helper
    use ErrorHandler, RequestHelper;
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
        //Calls the object statically form splash object
        //open for editing not only post request are used
        return static::arrToObj($_POST ?? $_GET);

    }

}
