<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\Article;
use App\Model\User;
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

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $articles = $this->article->all();

        $this->view('index', compact('articles'));
    }

    /**
     * delete
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function delete($id)
    {

        if (request()->isPost()) {

            $article = $this->article->find('id', $id);

            if ($article) {

                if (auth()->user()->id == $article->user_id) {

                    $deleted = $this->article->where('id', $id)->delete();

                    if ($deleted) {

                        flashMessage()->success('مقاله مورد نظر شما با موفقیت حذف گردید.');
                        redirect_back();
                        return;
                    }

                    flashMessage()->error('مشکلی در حذف مقاله بوجود آمده است.');
                    redirect();
                } else {

                    flashMessage()->error('شما مجاز به حذف این مقاله نیستید.');
                    redirect();
                }
            } else {

                flashMessage()->error('مقاله مورد نظر شما موجود نمیباشد.');
                redirect();
            }
        } else {

            redirect();
        }
    }

    /**
     * edit
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function edit($id)
    {

        $article = $this->article->find('id', $id);

        if (!$article) {

            redirect();
        }

        if (auth()->user()->id != $article->user_id) {

            redirect();
        }

        $this->view('edit', compact('article'));
    }

    /**
     * update
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function update($id)
    {

        if (request()->isPost()) {
            $article = $this->article->find('id', $id);

            if (!$article) {

                redirect();
            }

            if (auth()->user()->id != $article->user_id) {

                redirect();
            }

            $rules = [
                'title' => 'required',
                'description' => 'required|min:10',
            ];

            $validation = new Validation();

            $is_valid = $validation->make(request()->all(), $rules);

            if ($is_valid) {
                // need to authroize by password

                $slug = slugify(request('title'));

                $updated = $this->article->where('id', $id)->update([
                    'title' => request('title'),
                    'body' => request('description'),
                    'slug' => $slug,
                    'updated_at' => Carbon::now(),
                ]);

                if ($updated) {

                    flashMessage()->success('مقاله با موفقیت بروزرسانی شد.');

                    redirect('/articles/show/' . $slug, true);
                } else {

                    flashMessage()->error('مشکلی در انتشار مقاله بوجود آمده است.');

                    redirect('/articles/update/' . $id, true);
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

            redirect();
        }
    }

    /**
     * show
     *
     * @param  mixed $slug
     *
     * @return void
     */
    public function show($slug)
    {

        $article = $this->article->find('slug', $slug);

        if (!$article) {

            redirect();
        }

        $author = (new User)->find('id', $article->user_id);

        $this->view('single', compact('article','author'));
    }

    /**
     * create
     *
     * @return void
     */
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

                    redirect('/dashboard', true);
                } else {

                    flashMessage()->error('مشکلی در انتشار مقاله بوجود آمده است.');

                    redirect('/articles/create', true);
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
