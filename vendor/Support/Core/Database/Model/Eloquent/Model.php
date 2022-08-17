<?php

namespace Illuminate\Core\Database\Model;

use Illuminate\Core\Database\Eloquent\ModelHandler;
use Illuminate\Core\Database\ModelHandler\Eloquent;

class Model extends ModelHandler
{
    /**
     * has the connection to the database
     */
    protected $connection;
    
}
