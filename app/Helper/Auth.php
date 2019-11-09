<?php

namespace App\Helper;

use App\Application\Contracts\AuthInterface;
use App\Model\User;

class Auth implements AuthInterface
{
    /**
     * login
     *
     * @param  object $user
     * @param  bool $remember
     *
     * @return bool
     */
    public function login(object $user, bool $remember = true): bool
    {
        // set session and cookie
        session('email', $user->email);

        if ($remember) {

            $user_src = new User;

            $remember_token = myrandom(90);

            $approved = $user_src->where('id', $user->id)->update(['remember_token' => $remember_token]);

            if ($approved) {

                cookie('remember_token', $remember_token);
            }
        }

        return true;
    }

    /**
     * logout
     *
     * @return bool
     */
    public function logout(): bool
    {
        //
        session()->forget('email');
        cookie()->forget('remember_token');

        return true;
    }

    /**
     * check
     *
     * @return bool
     */
    public function check(): bool
    {
        //


        if (session('email') !== false) {

            $user = (new User())->find('email', session('email'));

            if ($user !== false)
                return true;

            $this->logout();

            return false;
        } else if (cookie()->exist('remember_token')) {

            $user = new User;

            $remember_token = cookie('remember_token');

            $data = $user->find('remember_token', $remember_token);

            if ($data !== false) {

                if (session('email') === false) {

                    session('email', $data->email);
                }

                return true;
            }
        }

        return false;
    }

    /**
     * user
     *
     * @return object
     */
    public function user(): object
    {
        if (!$this->check()) {

            return false;
        }

        $user = new User;

        return $user->find('email', session('email'));
    }
}
