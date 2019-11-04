<?php

namespace App\Application;

class Session
{

    public static function add($key, $value)
    {
        $_SESSION[$key] = $value;
        return new self();
    }

    public static function get($key)
    {

        return $_SESSION[$key];
    }
}
