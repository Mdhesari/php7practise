<?php

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
