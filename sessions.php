<?php

session_start();

$_SESSION['email'] = 'mdhesari99@gmail.com';

if (isset($_SESSION['email']))
    echo $_SESSION['email'];

session_unset();
session_destroy();
