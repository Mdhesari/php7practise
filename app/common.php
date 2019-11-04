<?php

use \Plasticbrain\FlashMessages\FlashMessages;

if (!function_exists('dd')) {
    function dd($var = null)
    {
        var_dump($var);
        die();
    }
}

if (!function_exists('get_head')) {
    function get_head()
    {
        include_once __DIR__ . './views/inc/header.php';
    }
}

if (!function_exists('get_footer')) {
    function get_footer()
    {
        include_once __DIR__ . './views/inc/footer.php';
    }
}

if (!function_exists('redirect')) {
    function redirect($url = URL_ROOT)
    {

        $pattern = "/^htt(p|s):\/\//i";

        $pattern_2 = "/^\//i";

        if (preg_match($pattern_2, $url)) {

            $url = URL_ROOT . $url;
        } elseif (!preg_match($pattern, $url)) {

            $url = "http://" . $url;
        }

        redirect($url);
        header('Location: ' . $url);
    }
}

if (!function_exists('redirect_back')) {

    function redirect_back()
    {
        redirect($_SERVER['HTTP_REFERER']);
    }
}

if (!function_exists('flashMessage')) {
    function flashMessage()
    {
        return new FlashMessages;
    }
}

if (!function_exists('get_current_url')) {
    function get_current_url()
    {
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        return $link;
    }
}

function print_array($errors)
{

    foreach ($errors as $errors_) {
        foreach ($errors_ as $error)
            echo "<p>{$error}</p>";
    }
}
