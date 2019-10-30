<?php

require_once __DIR__ . './vendor/autoload.php';

use App\Controller\Users;

$user = new Users;

$user->register();