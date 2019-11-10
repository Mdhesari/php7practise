<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\Article;
use Carbon\Carbon;
use App\Helper\Validation;

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

    public function index()
    {
        $articles = $this->article->all();

        $this->view('index', compact('articles'));
    }

    public function show($slug)
    {

        $article = $this->article->find('slug', $slug);

        $this->view('single', compact('article'));
    }

    public function create()
    {


        if (request()->isPost()) {


            $rules = [
                'title' => 'required',
                'description' => 'required|min:10',
            ];

            $validation = new Validation();

            $is_valid = $validation->make(request()->all(), $rules);

            if ($is_valid) {
                // need to authroize by password

                $article = $this->article->insert([
                    'title' => request('title'),
                    'user_id' => auth()->user()->id,
                    'body' => request('description'),
                    'slug' => slugify(request('title')),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                if ($article) {

                    flashMessage()->success('مقاله با موفقیت انتشار شد.');

                    redirect('dashboard');
                } else {

                    flashMessage()->error('مشکلی در انتشار مقاله بوجود آمده است.');

                    redirect('articles/create');
                }
            } else {
                // user's data is not validated
                $errors = $validation->getErrors();
                $error_text = "";

                foreach ($errors as $errors_item) {
                    foreach ($errors_item as $error) {
                        if (is_string($error))
                            $error_text .= $error . "<br>";
                    }
                }

                flashMessage()->error($error_text);
                $this->view('create');
            }
        } else {

            $this->view('create');
        }
    }
}
