<?php

namespace App\Controller;

class Controller
{

    protected $action = "Controller";

    public function __construct()
    {
        $this->setAction();
    }

    private function setAction()
    {
        $class_name = \explode('\\', \get_called_class());

        $this->action = $class_name[count($class_name) - 1];
    }
}
