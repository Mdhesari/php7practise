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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}

$mytest = new Test('ahmad');
echo $mytest->getName() . '<br>';
$mytest2 = clone $mytest;
$mytest2->setName('reza');
echo 'test 2' . $mytest2->getName() . '<br>';
echo 'test 1 ' . $mytest->getName() . '<br>';

// $test1 = 1;
// $test2 = &$test1;
// ++$test2;
// echo $test1;
// echo "<br>";
// echo $test2;
