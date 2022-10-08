<?php



class autoloadHelper {

  public $replacables = [];
  
  public $dir = __DIR__.'./../../composer.json';
  /**
  *takes the json file in the dir and makes it a standard class
   */
  public function parse_json($dir) {
	$file_cont = file_get_contents($dir);
	$cont = json_decode($file_cont);
	return $cont;
  } 
  
  /**
 *Replaces all the backSlash with the forward slash
 */
 public function cleanNamespace($namespace) {
 
   $namespace = str_replace("\\", "/", $namespace);
   
   return $namespace;
   
 }
 
  /**
  *Sets the variable replacable for the replacable namespaces
  */
  public function setReplacables()
   {
  $autoloader = $this->parse_json($this->dir);
  return $autoloader->autoload->{"psr-4"};
  
  }

  
  /**
  *Takes a class and replaces it with the real dir
  */
  public function replaceNamespace($class) {
  
  	
  	
  	$replacable = $this->setReplacables();
  	
  	foreach($replacable as $key => $value) {
  	
  	if (preg_match("!.*$key.*!", $class)) {
  	
  	   $class = str_replace($key, $value, $class);
  	   break;
       }
  }
  	return $this->cleanNamespace($class);
  	
  }

  

}