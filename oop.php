<?php

class Test
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->name;
    }

}

$mytest = new Test('ahmad');

$test1 = 1;
$test2 = &$test1;
++$test2;
echo $test1;
echo "<br>";
echo $test2;
