<?php

namespace App\Application;

use App\Model\DB;

class Core extends DB
{

    /**
     *  main app controller source 
     * 
     * @var string
     */
    protected static $controller            = "Home";

    /**
     *  action to open view
     * 
     * @var string
     */
    protected static $method                = "index";

    /**
     *  parameters passed in controller 
     * 
     * @var array
     */
    protected static $params                = [];


    /** 
     * Initialize the application
     * 
     * @return void
     */
    public static function init()
    {

        $url = self::getUrl();

        if (isset($url[0])) {
            if (file_exists(APP_ROOT . '/controller/' . ucfirst($url[0]) . '.php')) {
                self::$controller = $url[0];
                unset($url[0]);
            }
        }


        $controller = "\App\Controller\\" . self::$controller;

        if (isset($url[1])) {
            if (method_exists($controller, strtolower($url[1]))) {
                self::$method = $url[1];
                unset($url[1]);
            }
        }

        self::$controller = new $controller();

        self::$params = $url ? array_values($url) : [];

        call_user_func_array([self::$controller, self::$method], self::$params);

        return self::end();
    }

    /**
     * Get client urls
     * 
     * @return array
     */
    public static function getUrl(): array
    {

        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }

        return [];
    }

    /**
     * end
     *
     * @return void
     */
    public static function end()
    {
        cookie('last_url', get_current_url());
    }
}
