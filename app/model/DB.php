<?php

namespace App\Model;

use App\Application\traits\database\Properties;
use Exception;
use PDO;

class DB
{
    use Properties;

    public function __construct()
    {

        $this->setupClass();

        $database = $this->config['connection']['mysql'];

        $dsn = "mysql:host={$database['host']};dbname={$database['database']};charset={$database['charset']}";

        try {

            $this->pdo = new PDO($dsn, $database['user'], $database['password']);
        } catch (Exception $error) {

            die("Database Error Occured : " . $error->getMessage());
        }
    }

    private function setupClass()
    {

        $this->setConfig();

        if ($this->table === null || empty($this->table)) {
            $this->setTable();
        }
    }

    private function setConfig()
    {
        $this->config = require_once __DIR__ . '/../config.php';
    }

    private function setTable()
    {
        $class_name = \explode('\\', \get_called_class());

        $this->table = $class_name[count($class_name) - 1];
    }


    public function select()
    {

        $this->stmt =  $this->pdo->prepare("SELECT *
                             FROM {$this->table}");

        return $this;
    }

    public function get()
    {
        $this->done();

        return $this->stmt->fetchAll(PDO::FETCH_BOTH);
    }

    private function done()
    {
        $this->stmt->execute();
    }
}
