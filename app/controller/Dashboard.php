<?php

namespace App\Controller;

use App\Controller\Controller;

use App\Model\Article;

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

        $articles = (new Article)->where('user_id', $user->id)->all();

        $this->view('index', compact('user', 'articles'));
    }
}
