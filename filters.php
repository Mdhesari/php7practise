<?php

// Looping through filter list
/* foreach (filter_list() as $id => $data) {
    echo $data . '<br>id' . filter_id($data) . '<br>';
} */

function getUserIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function linkCreator($url)
{
    return "<a href='$url'>$url</a>";
}

$str = "<h1>Hello world</h1>";
$num = 1;
// localhost = 127.0.0.1 => loop back
$myip = getUserIpAddr();
$url = "https://www.nimckat.com";

// Sanitize string
$str = filter_var($str, FILTER_SANITIZE_STRING);

// Sanitize int
$num = filter_var($num, FILTER_VALIDATE_INT);

// Validate IP
$myip = filter_var($myip, FILTER_VALIDATE_IP) ? '<br> Your IP is valid.' : '<br> Your IP is invalid!';

// Validate URL
$url = filter_var($url, FILTER_SANITIZE_URL);

$UserID = 10;
$options =  [
    'options' => ['min_range' => 1, 'max_range' => 10]
];

$UserID = filter_var($UserID, FILTER_VALIDATE_INT, $options) ? "true" : "false";

// Validate IPv6
$ip = "2001:0db8:85a3:08d3:1319:8a2e:0370:7334";

$ip = filter_var($myip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ? "TRUE" : "FALSE";

// Validate url with query string
$qurl = "https://www.nimckat.com/?s=hello";

$qurl = filter_var($qurl, FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED) ? "TRUE" : "FALSE";

// Validate ASCII value > 127
$str = "<h1>Hello there Ø</h1>";

echo filter_var($str,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);