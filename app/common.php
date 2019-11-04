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
    function redirect($url = URL_ROOT, $from_root = false)
    {
        if ($from_root !== false) {
            $url = URL_ROOT . $url;
        }

        $pattern = "/^htt(p|s):\/\//i";

        if (!preg_match($pattern, $url)) {

            $url = "http://" . $url;
        }

        header('Location: ' . $url);
    }
}

if (!function_exists('redirect_back')) {

    function redirect_back()
    {

        redirect(\App\Application\Session::get('last_url'));
    }
}

if (!function_exists('flashMessage')) {
    function flashMessage()
    {
        return new \Plasticbrain\FlashMessages\FlashMessages;
    }
}

if (!function_exists('get_current_url')) {
    function get_current_url()
    {
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        return $link;
    }
}

if (!function_exists('old')) {
    function old($key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : '';
    }
}

function print_array($errors)
{

    foreach ($errors as $errors_) {
        foreach ($errors_ as $error)
            echo "<p>{$error}</p>";
    }
}
