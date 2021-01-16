<?php

namespace app\validation;


abstract class Validator
{
    private $errors = [];

    abstract function validate(): bool;

    public function setError($name,$message)
    {
        $this->errors[$name] = $message;
    }

    public function getErrors()
    {
        return $this->errors;
    }

}