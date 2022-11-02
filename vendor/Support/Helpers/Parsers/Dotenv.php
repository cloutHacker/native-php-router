<?php

namespace Illuminate\Support\Helpers\Parsers;

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

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}