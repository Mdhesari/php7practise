<?php

namespace App\Controller;

    class Controller
{
    /**
     * database variable
     * 
     * @return void
     */

    public function index(): void
    {

        $this->view('index');
    }

    /**
     * view
     *
     * @param  string $location
     * @param  array $data
     *
     * @return void
     */
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
            redirect();
            // die('No file Exist.');
        }
    }

    /**
     * getCalledClassName
     *
     * @return string
     */
    private function getCalledClassName(): string
    {
        $class_name = \explode('\\', \get_called_class());

        return $class_name[count($class_name) - 1];
    }
}
