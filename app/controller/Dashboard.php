<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\User;

class Dashboard extends Controller
{

    private $user;

    public function __construct()
    {
        if (!auth()->check()) {

            redirect();
        }

        $this->user = new User;
    }

    public function index(): void
    {

        //
        $user = auth()->user();

        dd($user);

        $this->view('index', compact('user'));
    }
}
