<?php

// strict_types affects type coercion
declare (strict_types = 1);
// date_default_timezone_set('Asia/Tehran');
// echo date_default_timezone_get();

$myfile = fopen('myjs.txt','a+') or die('unable to open');

while(!feof($myfile)){
    echo fgets($myfile) . '<br>';
}



// $t_stamp = strtotime('+1 month');
// echo date('Y/m/d',$t_stamp) . "<br>";
// class Practice
// {
//     /**
//      * Getting sum of two numbers
//      * Here I just wanted to test new type feature in php7
//      *
//      * @param integer $a
//      * @param integer $b
//      * @return integer
//      */
//     public function sum(int $a, int $b): int
//     {
//         return $a + $b;
//     }

//     public function printAArrKeys($arr)
//     {
//         foreach ($_SERVER as $server => $val) {
//             echo $server . "#######<br>";
//         }
//     }

//     public function formatPersianDay()
//     {

//         $day = strtolower(date('l'));

//         switch ($day) {
//             case 'saturday':
//                 $day = 'شنبه';
//                 break;
//             case 'sunday':
//                 $day = 'یکشنبه';
//                 break;
//             case 'monday':
//                 $day = 'دوشنبه';
//                 break;
//             case 'tuesday':
//                 $day = 'سه شنبه';
//                 break;
//             case 'wednesday':
//                 $day = 'چهارشنبه';
//                 break;
//             case 'thursday':
//                 $day = 'پنجشنبه';
//                 break;
//             default:
//                 $day = 'جمعه';
//                 break;
//         }

//         return $day;
//     }
// }

// // instanciate practice class
// $mypractice = new Practice;

// $myarr = [
//     'name' => "mohamad fazel",
//     'age' => 18,
//     'job' => 'entrepreneur',
//     'agency' => 'nimckat',
//     'education' => 'diploma',
//     'projects' => [
//         'website design template',
//         'catch game',
//         'share post media',
//         'shopping platform',
//         'react app'
//     ]
// ];

// // $mypractice->printAArrKeys($myarr);

// // echo $_SERVER['SERVER_ADDR'];

// echo $mypractice->formatPersianDay();


// /* arsort($myarr);
// print_r($myarr); */




// // echo $mycar->sum(1,3);

// // echo 6 <=> 6;
