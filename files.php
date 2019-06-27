<?php

require_once 'header.php';

$myfile = fopen('myFile.txt','w+');
fwrite($myfile,'Hello herby I say I love you.');
fclose($myfile);
$myfile = fopen('myFile.txt','a+');
echo fread($myfile,filesize('myFile.txt'));
fclose($myfile);

