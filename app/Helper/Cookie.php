<?php

namespace App\Helper;

use App\Application\Contracts\Repository;

class Cookie implements Repository
{

    /**
     * get
     *
     * @param  mixed $key
     *
     * @return void
     */
    public function get(string $key)
    {

        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : false;
    }

    /**
     * set
     *
     * @param  mixed $key
     * @param  mixed $value
     * @param  mixed $time
     *
     * @return bool
     */
    public function set(string $key, $value, $time = "+30 days"): bool
    {

        setcookie($key, $value, strtotime($time));

        return $this->exist($key);
    }

    /**
     * exist
     *
     * @param  mixed $key
     *
     * @return bool
     */
    public function exist(string $key): bool
    {
        if ($this->get($key) !== false) {

            return true;
        }

        return false;
    }

    /**
     * forget
     *
     * @param  mixed $key
     *
     * @return bool
     */
    public function forget(string $key): bool
    {
        unset($key);

        if (!$this->exist($key)) {
            return true;
        }

        return false;
    }
}
