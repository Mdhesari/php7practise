<?php

declare (strict_types = 1);

function myecho($str)
{
    echo $str . '<br>';
}

function echoArr($array)
{
    foreach ($array as $key => $val) {
        echo '  ' . $key + 1 . ' : ' . $val . '<br>';
    }
}

class Car
{
    private $name;
    private $brand;
    private $features;
    private $speed;

    public function __construct(string $name, string $brand, array $features = [], int $speed = 200)
    {
        $this->name = $name;
        $this->brand = $brand;
        $this->features = $features;
        $this->speed = $speed;
    }

    public function setSpeed(int $num)
    {
        $this->speed = $num;
    }

    public function displayInfo()
    {
        myecho('Name : ' . $this->name);
        myecho('Brand : ' . $this->brand);
        if (count($this->features) > 0) {
            myecho('Features : ');
            echoArr($this->features);
        }
        myecho('speed : ' . $this->speed);
    }
}

class Truck extends Car
{ }

$mytruck = new Truck('Tacoma', 'Toyota', ['Camper shells', 'V8 Engine'], 150);
$mytruck->setSpeed(123);
$mytruck->displayInfo();
echo true | 0;

// Try out anonymous class
$anonymous = new class ('hi')
{
    public function __construct($test)
    {
        echo $test;
    }
};
