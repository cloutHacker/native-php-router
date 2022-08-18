<?php

namespace Illuminate\Support\Core\Database\Model\Eloquent;

use Illuminate\Support\Helpers\Objects\SplashObject;

abstract class ModelHandler extends SplashObject
{
    protected $dbResult = [];
    
    /**
     * @param array $arr
     * pushes array values to the designated table
     */
    public function create($data)
    {
        return $this->loadData($data);
    }
    /**
     * @param string $input
     * @return arr $output
     * returns database result for a certain search
     */
    public function find(string $input)
    {
    }
    /**
     * return database results for a certain row or column of a table
     */
    public function where(string $value, $modifier = '=', $dbValue): object
    {
        return $this;
    }
    /**
     * @param null
     * returns all the database entities
     */
    public static function all()
    {

    }
    /**
     * @param null
     * returns the result of a certain search
     */
    public function get()
    {
    }
    public function loadData($data)
    {
        return is_object($data) ? $this->loadArr($this->objToArr($data)) : $this->loadArr($data);
    }
    /**
     * @param array $data
     * @return void
     *The function gives all the property of the model a value from the data given
     */
    public function loadArr(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

}
