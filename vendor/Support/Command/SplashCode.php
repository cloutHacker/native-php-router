<?php

namespace Illuminate\Support\Command;
//This file is included in the App\kernel where it is accessed 
//This Trait validates and runs the commands entered in the CLI throught splash file

trait SplashCode
{
    /**
    * Entails if the command
    */
    protected static $command = '';
    /**
    *Entails the value of the command entered
    */
    protected static $value = '';
    /**
    * Declares if the command entered is valid
    */
    protected static $isValid = false;
    use Text;
    protected $logo = '
    _____    _____   __            /\       _____   __    __
   / ____|  |  __ \  | |          /  \     / ____|  | |   | |
  | |_____  | /  \ | | |         / /\ \   | |____   | |___| |
   \____  \ | \_ / | | |        / /__\ \   \___  \  |  ___  |
    ____| | |  ___/  | |____   /  ____  \  ____|  | | |   | |
    |_____/ |_|      |______| / _/    \ _\ |_____/  |_|   |_|
    
    ';

    protected $controllerDir = __DIR__ . './../../../app/Http/Controllers/';
    protected $modelDir = __DIR__ . './../../../app/Models/';
    protected $migration;
    /**
     * @param int $code
     * @return consoleString 
     */
    public function colorize(int $code, $text): string
    {
  	
        return $this->returnConsole($code, $this->logo.$text);
    }

    /**
     * @param string $code 
     * return console text with a color
     */
    public function returnConsole(int $code, $text)
    {
        echo "\033[" . $code . "m" . "$text" . "\e[0m";
        return "";
    }

    /**
     * @param string $command 
     * @param string $value
     * @return null
     * assign commands their functions
     */
    public function assignCommand()
    {
        return self::$isValid ? $this->assignFunc(self::$command, self::$value) : 
        $this->colorize($this->code['red'], 'Invalid command Entered');
    }

    /**
     * @param string $command 
     * @param string $value
     * assign every function according to the command given
     */
    public function assignFunc($command, $value)
    {
        if (preg_match('#\w+:\w+#', $command)) {
            $parts = explode(":", $command);
            $func = $parts[0];
            $commandval = $parts[1];
            //Checks if the method entered by the user in the CLI exists
            return $this->cli_method($func, $commandval,$value);
            
        } elseif (preg_match('#\w+#', $command)) {
       	//executes when there is no use of colon (:) in the cli
            return $this->cli_method($command);
        }
        else {
            return $this->$command;
        }
        return $this->colorize($this->code['red'], 'Unknown command');
    }
     /**
    * Checks if a method exists else returns a CLI error
    */
    public function cli_method($method, ...$args) {
    //returns an error of invalid command if the method is not found
       return method_exists($this, $method) ? $this->$method(...$args) : $this->colorize($this->code['blue'], "Invalid command entered");
    }

    /**
     * @param string $command
     * @param string $value
     */
    public function make($command, $value)
    {
        return $this->$command($value);
    }

    /**
     * @param string $value
     * generates the controller with its contents
     */
    public function controller($value)
    {
        return $this->genController($value, $this->controllerDir);
    }

    /**
     * @param string $value
     * generates model with model contents in it
     */
    public function model($value)
    {
        return $this->genModel($value, $this->modelDir);
    }
    /**
     * @param null
     * validates if the command is found
     */
    public function validateCommand($argv) {
    //checks if the command args is more than one to acertain if the command entered is valid
        $count = count($argv);
        if ($count == 3) {
            self::$command = $argv[1];
            self::$value = $argv[2];
            self::$isValid = true;
        }
        elseif($count == 2) {
            self::$command = $argv[1];
            self::$isValid = true;
        }
	return $this;
    }
    /**
    * Starts the project on a certain port
    */
    public function serve() {

        exec("php -S localhost:200");
        
    }
}
