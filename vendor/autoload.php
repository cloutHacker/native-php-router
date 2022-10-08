<?php

$file = require __DIR__.'./autoloader/autoloadHelper.php';

function autoload($class) {

$autoloader = new autoloadHelper();

$namespace = $autoloader->replaceNamespace($class);
include_once $namespace.".php";

}
spl_autoload_register("autoload");