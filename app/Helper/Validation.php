<?php

namespace App\Helper;

class Validation
{

    protected $rules;

    protected $data;

    private $errors;

    public function make(array $data, array $rules): bool
    {
        $this->data = $data;
        $this->rules = $rules;

        $valid = true;

        return $valid;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
