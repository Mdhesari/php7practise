<?php
// An interface is an empty shell
interface Logger
{
    function execute($message);
}

class LogToDatabase implements logger
{
    public function execute($message)
    {
        var_dump($message);
    }
}

class LogToFile implements logger
{
    public function execute($message)
    {
        var_dump($message);
    }
}

class UserController
{
    protected $logger;
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function show($user)
    {
        $this->logger->execute($user);
    }
}

$nahid = new UserController(new LogToDatabase);
$show = $nahid->show('reza');

// new interface practice
interface Data
{
    function setName($name);
    function setFamily($family);
    function setNationalCode($code);
    function setAreaCode($code);
    function printAll();
}
interface User
{
    function getName();
}

class Login implements User, Data
{

    private $name;
    private $family;
    private $national_code;
    private $area_code;

    function setFamily($family)
    {
        $this->family = $family;
    }
    function setNationalCode($code)
    {
        $this->national_code = $code;
    }
    function setAreaCode($code)
    {
        $this->area_code = $code;
    }
    function getName()
    {
        return $this->name;
    }
    function setName($name)
    {
        $this->name = $name;
    }
    function printAll()
    {
        myecho($this->name);
        myecho($this->family);
        myecho($this->national_code);
        myecho($this->area_code);
    }
}

class Register implements Data
{
    private $name;
    private $family;
    private $national_code;
    private $area_code;

    function setFamily($family)
    {
        $this->family = $family;
    }
    function setNationalCode($code)
    {
        $this->national_code = $code;
    }
    function setAreaCode($code)
    {
        $this->area_code = $code;
    }
    function setName($name)
    {
        $this->name = $name;
    }
    function printAll()
    {
        myecho($this->name);
        myecho($this->family);
        myecho($this->national_code);
        myecho($this->area_code);
    }
}

class Authorize
{
    private $obj;
    public function __construct(Data $obj)
    {
        $this->obj = $obj;
    }
}


/* $mylogin = new Login();
$mylogin->setName('mohamad');
echo $mylogin->getName();
 */

 $mylogin = new Login;
 $newUser = new Authorize($mylogin);
 print_r($newUser); 