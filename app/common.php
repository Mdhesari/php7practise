<?php

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

        if (!preg_match($pattern, $url)) {

            $url = "http://" . $url;
        }

        header('Location: ' . $url);
    }
}

function print_array($errors)
{

    foreach ($errors as $errors_) {
        foreach ($errors_ as $error)
            echo "<p>{$error}</p>";
    }
}
