<?php

/**
 * Autoload every file that is on app directory
 */

if (!session_id()) @session_start();

// load packages
require_once __DIR__ . './../vendor/autoload.php';

// application config
require_once __DIR__ . './../app/constants.php';

require_once __DIR__ . './../app/common.php';
