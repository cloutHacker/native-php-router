<?php

namespace Illuminate\Support\Helpers\Objects;


class SplashObject {
    /**
     * @param array $array
     * @return object
     * The function returns an object as it turn the single elements to objects
     * 
     */
    public function arrToObj(array $array) {
        $object = new class{};
        foreach ($array as $key => $val) {
            $object->$key = $val; 
        }
        return $object;
    }
    /**
     * @param object $object
     * The function takes in an object and returns an associative array
     */
    public function objToArr(object $object) {
        $arr = [];
          foreach($object as $key => $value) {
            $arr[$key]= $value;
          }
          return $arr;
    }
}