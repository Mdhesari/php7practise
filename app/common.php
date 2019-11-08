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

        redirect(\App\Helper\Session::get('last_url'));
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

function session($key = null, $value = null, $time = "+30 days")
{

    $session = new \App\Helper\Session;

    if (is_null($key)) {

        return $session;
    }

    if (is_null($value)) {

        return $session->get($key);
    }

    return $session->set($key, $value, $time = "+30 days");
}

function cookie($key = null, $value = null, $time = "+30 days")
{

    $cookie = new \App\Helper\Cookie;

    if (is_null($key)) {

        return $cookie;
    }

    if (is_null($value)) {

        return $cookie->get($key);
    }

    return $cookie->set($key, $value, $time);
}

function request($field = null, $post = true)
{
    $request = new App\Helper\Request;
    if (is_null($field)) {
        return $request;
    }

    return $request->input($field, $post);
}

function print_array($errors)
{

    foreach ($errors as $errors_) {
        foreach ($errors_ as $error)
            echo "<p>{$error}</p>";
    }
}

function auth(){

    return new App\Helper\Auth;
}

function myrandom($length = 16)
{
    $str = '';

    $bytes = base64_encode(random_bytes($length));

    $bytes = str_replace(['/', '+', '='], '', $bytes);

    $str .= substr($bytes, 0, $length);

    return $str;
}

