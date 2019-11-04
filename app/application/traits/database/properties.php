<?php
namespace App\Application\traits\database;

trait Properties
{

    protected $pdo = null;

    protected $table;

    protected $config;

    protected $stmt;

    protected $errros = [];

    protected $data = [];

    protected $query = "";  
}
