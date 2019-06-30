<?php
// A foundation for another class, some methods are already defined and must be used
abstract class Template
{
    protected function addSugar()
    {
        var_dump('Add proper amount of sugar');
        return;
    }

    protected function addHotWater()
    {
        var_dump('Pour hot water into cup');
        return;
    }

    protected function addMaterial()
    {
        var_dump('Add proper amount of powder');
        return;
    }

    public abstract function make();
}

class Tea extends Template
{
    public function make()
    {
        $this->addHotWater();
        $this->addSugar();
        return $this->addMaterial();
    }
}

class Coffee extends Template
{
    protected function addMilk()
    {
        var_dump('Add proper amount of milk');
        return;
    }

    public function make()
    {
        $this->addHotWater();
        $this->addSugar();
        $this->addMaterial();
        return $this->addMilk();
    }
}

$myCoffee = new Tea;
$myCoffee->make();

abstract class Food
{
    protected $name, $colour;

    public function __construct($name, $colour)
    {
        $this->name = $name;
        $this->colour = $colour;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getColour()
    {
        return $this->colour;
    }

    public abstract function getData();
}

class Benana extends Food
{

    protected $price;

    public function __construct($name, $price, $colour = null)
    {
        // parent::__construct(...func_get_args());
        parent::__construct($name, $colour);
        $this->price = $price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getData()
    {
        echo "Hello and Welcome.<br>";
        echo "Name : " . $this->name . "<br>";
        echo "Price : " . $this->price . "<br>";
    }
}

$mybenana = new Benana('benana', 10000);
$mybenana->getData();

$arr = array(1, 3, 4);

function plusNumbers(...$arr)
{
    $sum = 0;
    foreach ($arr as $num) {
        $sum += $num;
    }
    return $sum;
}

function add($n1, $n2, $n3)
{
    return $n1 + $n2 + $n3;
}

// echo add(...$arr);
echo plusNumbers(1,3,4,32,5);
