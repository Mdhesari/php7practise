<?php
// An interface is an empty shell
interface Logger
{ 
    public function execute($message);
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
echo $nahid->show('reza');
