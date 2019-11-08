<?php

namespace App\Application\Contracts;

interface Repository
{

    /**
     * get
     *
     * @param  mixed $key
     *
     * @return void
     */
    public function get(string $key);

    /**
     * set
     *
     * @param  mixed $key
     * @param  mixed $value
     * @param  mixed $time
     *
     * @return bool
     */
    public function set(string $key, $value, $time = '+30 days'): bool;

    /**
     * exist
     *
     * @param  mixed $key
     *
     * @return bool
     */
    public function exist(string $key): bool;

    /**
     * forget
     *
     * @param  mixed $key
     *
     * @return bool
     */
    public function forget(string $key): bool;
}
