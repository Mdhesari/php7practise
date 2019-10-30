<?php

require_once __DIR__ . './vendor/autoload.php';

use App\Model\Users;

$db = new Users;

var_dump($db->select()->get());
