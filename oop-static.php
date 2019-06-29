<?php

class hyperClass
{
    public static $name = "MyName";
    public static function setName($name)
    {
        self::$name = $name;
    }
}

class superClass extends hyperClass
{ 
    public static function setName($name)
    {
        parent::$name = $name . " -- ";
    }
}

superClass::setName('mohamad');
echo superClass::$name;