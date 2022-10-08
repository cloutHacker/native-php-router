<?php

namespace Illuminate\Support\Command;

trait Text
{
    /**
     * returns the color codes
     */
    protected $code = [
        'red' => 31,
        'green' => 32,
        'yellow' => 33,
        'blue' => 34,
        'white' => 37
    ];

    protected $controllerText = "<?php

 namespace App\Http\Controllers;
        
 use App\Http\Controllers\Controller;
use Illuminate\Support\Interfaces\Validation\Request;

 class {} extends Controller
 {  
    //
    
}";
    protected $modelText = "<?php

namespace App\Models;

use Illuminate\Support\Core\Database\Model\Eloquent\Model;

class {} extends Model
{

}";
    /**
     * generates a controller with its contents
     */
    public function genController(string $name, $dir)
    {
        return $this->put_contents($this->controllerText, $name, $dir);
    }
    /**
     * generates a model with contents in it
     */
    public function genModel(string $name, string $dir)
    {
        return $this->put_contents($this->modelText, $name, $dir);
    }
    public function genMigration($name)
    {
    }
    /**
     * @return null
     * Puts contents of the model and the controller
     *if not exists
     */
    public function put_contents(string $source, string $name, string $dir)
    {
        $text  = str_replace('{}', $name, $source);
        $file = $dir . $name . ".php";
        if (!file_exists($file)) {
            echo $this->colorize($this->code['green'], "$name generate succesfully");
            return file_put_contents($file, $text);
        }
        echo $this->colorize($this->code['red'], "$name already exists");
    }
}
