<?php

namespace App\Controller;

use App\Model\DB;


class Controller extends DB
{

    protected $action = "Controller";

    public function __construct()
    {
        $this->setAction();
    }

    public function index()
    {

        $this->view('index');
    }

    public function view($location, $data = [])
    {

        if (empty($location)) {
            return;
        }

       extract($data);

        $location = explode('/', $location);

        if (count($location) == 1) {

            $directory = $this->getCalledClassName();

            $file = $location[0];
        } else {

            $directory = $location[0];

            $file = $location[1];
        }

        $location = APP_ROOT . './views/' . $directory . '/' . $file . '.php';

        if (file_exists($location)) {

            include_once $location;
        } else {

            die('No file Exist.');
        }
    }

    private function setAction()
    {
        $this->action = $this->getCalledClassName();
    }

    private function getCalledClassName()
    {
        $class_name = \explode('\\', \get_called_class());

        return $class_name[count($class_name) - 1];
    }
}
