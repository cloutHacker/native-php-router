<?php

namespace Illuminate\Support\Validation\Helpers;

trait Validator
{
    /**
     * @return string
     * returns (the first) validation error for each of the fields
     * 
     */
    private $errors = [];
    /**
     * validates post fields
     */
    public function validate($source = '', $requests)
    {
        foreach ($requests as $name => $validationRule) {
            $this->assignMethod($name, $validationRule);
        }
    }
    public function assignMethod($name, $request)
    {
        // var_dump($request);
        $request = explode('|', $request);
        foreach ($request as $requirement) {
            $this->assignFunc($requirement, $name);
        }
    }
    /**
     * @return object
     * takes in the name of the object and returns the value of the method or the property
     */
    public function getProperty($name)
    {
        $all = @$this->all();
        return property_exists($all, $name) ? $all->$name : die($this->throwError('', "Undefined Property $name"));
    }
    /**
     * returns an error if the field being given is empty
     */
    public function required(string $item, string $name)
    {
        return $item == '' && !$this->validationExists($name)
            ? $this->returnValidationError("$name field is required", $name) : '';
    }
    public function unique($name,$table)
    {
    }
    /**
     * @return array
     * returns an associative array if the email incorrect
     */
    public function email($email)
    {
        $name = 'email';
        return !preg_match("#\w+\.?@\w+\.\w+#", $email) && !$this->validationExists($name) ?
            $this->returnValidationError("$name field should be a valid email", $name) : '';
    }
    /**
     * @param string $val
     * @param string $name
     * @return array
     * returns an error if the min value is not attained
     */
    public function min(string $val, string $name)
    {
        $fieldVal = @count(str_split(($this->getProperty($name))));
        return $fieldVal < $val && !$this->validationExists($name)
            ? $this->returnValidationError("$name should not be less than $val", $name) : '';
    }
    /**
     * returns an error if the max value is surpassed
     */
    public function max(string $val, string $name)
    {
        $fieldVal = @count(str_split(($this->getProperty($name))));
        return $fieldVal > $val && !$this->validationExists($name)
            ? $this->returnValidationError("$name should not be greater than $val", $name) : '';
    }
    /**
     * @param string
     * returns an error if the field is not confirmed
     */
    public function confirmed(string $value, string $field) {
        $relativeField = $field.'_confirmation';
        $relValue = $this->getProperty($relativeField);
        return $relValue !== $value && !$this->validationExists($field) ?
        $this->returnValidationError("$field confirmation should match with the $field", $field) : ''; 
    }
    /**
     * @param string $request
     * takes in request requirement and assigns it the proper function
     */
    public function assignFunc(string $request, string $name)
    {
        $all = $this->all();
        if (preg_match('#\w+:\d#', $request)) {
            $req = explode(':', $request);
            $method = $req[0];
            return method_exists($this, $method) ? $this->$method($req[1], $name) : static::throwError('Undefined validation rule');
        }
        return method_exists($this, $request) && property_exists($all, $name) ? $this->$request($all->$name, $name) :
            die(static::throwError('', 'Undefined Validation rule'));
    }
    /**
     * @param string $error
     * @param string $name
     */
    public function returnValidationError(string $error, string $name)
    {
        return $this->errors[$name] = $error;
    }

    /**
     * returns true if the validation exists and false when it doesn't
     */
    public function validationExists(string $name): bool
    {
        return @$this->errors[$name] ? true : false;
    }
    /**
     * @param null
     * takes no arguments only returns a bool
     */
    public function hasErrors(): bool
    {
        return $this->errors !== [] ? true : false;
    }
    /**
     * @return array
     * returns all the errors of the request
     */
    public function errors()
    {
        return array_filter($this->errors, function ($error) {
            return $error !== '' ? $error : '';
        });
    }
}
