<?php

namespace App\Controller;

use App\Model\DB;


class Controller
{

    /**
     * database variable
     * 
     * @var object
     */
    protected $db;

    public function __construct()
    {
        $this->db = new DB;
    }

    public function index(): void
    {

        $this->view('index');
    }

    public function view(string $location, array $data = []): void
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

    private function getCalledClassName(): string
    {
        $class_name = \explode('\\', \get_called_class());

        return $class_name[count($class_name) - 1];
    }
}
