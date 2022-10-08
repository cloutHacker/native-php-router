<?php

namespace Illuminate\Support\Command;

trait SplashCode
{
    protected static $command = '';
    protected static $value = '';
    protected static $isValid = false;
    use Text;
    protected $logo = '
    _______     _____   __                   _______   _     _
   / _______|  |  __ \  | |          /\     / ______| | |   | |
  | |_____     | /  \ | | |         /  \   | |______  | |___| |
   \_______ \  | \_ / | | |        / __ \   \ _____  \|  ___  |
    ______ | | |  ___/  | |____   / /  \ \   ______| || |   | |
    |_______/  |_|      |______| /_/    \_\  |______/ |_|   |_|
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
        echo $this->logo;
        return $this->returnConsole($code, $text);
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
     var_dump("reached here");
        if (preg_match('#\w+:\w+#', $command)) {
            $parts = explode(":", $command);
            $func = $parts[0];
            $commandval = $parts[1];
            return $this->$func($commandval, $value);
        } elseif (preg_match('#\w+#', $command)) {
       
            return $this->$command();
        }
        else {
            return $this->$command;
        }
        return $this->colorize($this->code['red'], 'Unknown command');
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
    public function serve() {
        exec("php -S localhost:200");
    }
}
