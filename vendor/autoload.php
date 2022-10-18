<?php
//including the files from the autoloadHelper

$file = require __DIR__.'./autoloader/autoloadHelper.php';

//registers all the classes included

function autoload($class) {
$autoloader = new autoloadHelper();
//replacing all the namespace with its equivalents in comperson.lock.json
$namespace = $autoloader->replaceNamespace($class);
//including the original file
include_once $namespace.".php";
}

//registering all classes used
spl_autoload_register("autoload");