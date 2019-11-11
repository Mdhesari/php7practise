<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\User;

class Admin extends Controller
{

    protected $user;

    public function __construct()
    {
        if (!auth()->check()) {

            redirect();
        }

        $this->user = auth()->user();

        if ($this->user->type !== self::ADMIN_USER) {

            redirect();
        }
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {

        $users = (new User)->all();

        $this->view('index', compact('users'));
    }
}
