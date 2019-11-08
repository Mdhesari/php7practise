<?php

namespace App\Application\Contracts;

interface AuthInterface
{

    /**
     * login
     *
     * @param  object $user
     * @param  bool $remember
     *
     * @return bool
     */
    public function login(object $user, bool $remember = true): bool;

    /**
     * logout
     *
     * @return bool
     */
    public function logout(): bool;

    /**
     * check
     *
     * @return bool
     */
    public function check(): bool;

    /**
     * user
     *
     * @return object
     */
    public function user(): object;
    
}
