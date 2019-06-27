<?php

// 86400s => 1 day
// if (!isset($_COOKIE['test1'])) {
//     setcookie('test1', 'mohamad', time() + 86400 * 30, '/');
//     echo 'Hello, You are all set please agree cookie privacy policy.';
// } else {
//     echo "Hello " . $_COOKIE['test1'] . ' you are an old user.';
// }

// setRowCookie
if (!isset($_COOKIE['test2'])) {
    setrawcookie('test2', 'mohamad', time() + 86400 * 30, '/');
    echo 'Hello, You are all set please agree cookie privacy policy.';
} else {
    echo "Hello " . $_COOKIE['test2'] . ' you are an old user.';
}
