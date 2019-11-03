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
            // $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

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

        $this->table = strtolower($class_name[count($class_name) - 1]);
    }


    public function select()
    {

        $this->stmt =  $this->pdo->prepare("SELECT *
                             FROM {$this->table}");

        return $this;
    }

    public function checkErrors()
    {
        $this->errors = $this->stmt->errorInfo();
        return $this->errors;
    }

    public function get()
    {
        $this->done();

        return $this->stmt->fetchAll(PDO::FETCH_BOTH);
    }

    public function insert($data = [])
    {

        if (count($data) == 0)
            return;

        $query = "INSERT INTO {$this->table} (";

        $data_length = count($data);

        $i = 0;

        foreach ($data as $key => $value) {
            $query .= $key;

            if ($i == $data_length - 1) {
                $query .= ")";
            } else {
                $query .= " ,";
            }

            $i++;
        }

        $query .= " VALUES (";

        $i = 0;

        foreach ($data as $key => $value) {
            $query .= ':' . $key;

            if ($i == $data_length - 1) {
                $query .= ")";
            } else {
                $query .= " ,";
            }
            $i++;
        }

        $this->stmt = $this->pdo->prepare($query);


        foreach ($data as $key => $value) {
            $this->bind($key, $value);
        }

        if (!$this->done()) {
            dd($this->checkErrors());
        }
    }

    protected function bind($key, $value, $type = null)
    {

        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($key, $value, $type);
    }

    private function done()
    {
        return $this->stmt->execute();
    }

    public function __get($key)
    {
        return $this->data[$key];
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }
}
