<?php

/**
 * Autoload every file that is on app directory
 */

if (!session_id()) @session_start();


define('APP_ROOT', dirname(__DIR__) . '/app');
define('URL_ROOT', 'http://localhost/php7practise');

require_once __DIR__ . './../app/common.php';

require_once __DIR__ . './../vendor/autoload.php';

