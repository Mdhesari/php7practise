<?php

require_once __DIR__ . './bootstrap/autoload.php';

use App\Controller\Users;

$user = new Users;

$user->register();