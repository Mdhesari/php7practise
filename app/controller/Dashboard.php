<?php

namespace App\Controller;

use App\Controller\Controller;

class Dashboard extends Controller
{

    private $user;

    public function __construct()
    {
        if (!auth()->check()) {

            redirect();
        }

        $this->user = auth()->user();
    }

    public function index()
    {

        //
        $user = $this->user;

        $this->view('index', compact('user'));
    }
}
