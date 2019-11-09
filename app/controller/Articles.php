<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\Article;

class Articles extends Controller
{

    private $article;

    public function __construct()
    {
        if (!auth()->check()) {

            redirect();
        }

        $this->article = new Article;
    }

    public function index(): void
    {
        $articles = $this->article->all();

        $this->view('index', compact('articles'));
    }
}
