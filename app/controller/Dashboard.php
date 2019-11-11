<?php

namespace App\Controller;

use App\Controller\Controller;

use App\Model\Article;

class Dashboard extends Controller
{

    private $user;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        if (!auth()->check()) {

            redirect();
        }

        $this->user = auth()->user();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {

        //
        $user = $this->user;

        $articles = (new Article)->where('user_id', $user->id)->all();

        $this->view('index', compact('user', 'articles'));
    }

    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {

        flashMessage()->success('با موفقیت از حساب کاربری خود خارج شدید.');

        auth()->logout();

        redirect();
    }
}
