<?php

namespace Illuminate\Support\Helpers\Parsers;

/**
 * @author kibiwott
 */
class Dotenv {

    /**
     * The directory where the .env file exists
     * @var string
     */
    protected $path;
    
    /**
     * Sets the path of the env file 
     * @param string $path
     */
    public function __construct(string $path) {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException(sprintf('%s Does not exist'), $path);
        }
        $this->path = $path;
        
    }
    /**
     * Loads all the vars into the env variable
     * @param void
     */
    public function load() :void
    {
        if (!is_readable($this->path)) {
            throw new \RuntimeException(sprintf('%s file is not readable', $this->path));
        }
        //getting all the vars in the env file as variables in an associative array
        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        //looping through all the values of the array
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            //checking if the var already exists in the server of env global
            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                //pushing the env var
                putenv(sprintf('%s=%s', $name, $value));
                //putting the var into the env and the server variable
                $_ENV[$name] = $_SERVER[$name] =  $value;
            }
        }
    }

}