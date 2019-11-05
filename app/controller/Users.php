<?php

namespace App\Controller;

use App\Helper\Validation;
use App\Model\User;

class Users extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function register()
    {

        $this->view('register');
    }

    public function success()
    {

        $this->view('success');
    }

    public function submit()
    {

        if (request()->isPost()) {

            $rules = [
                'username' => 'required',
                'emailOrNumber' => 'required|emailnumber|unique:users__email',
                'password' => 'required',
                'password_confirm' => 'required|confirm:password',
            ];

            $validation = new Validation();

            $is_valid = $validation->make(request()->all(), $rules);

            if ($is_valid) {
                // user can submit

                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                // insert into db
                $result = $this->user->insert([
                    'name' => $_POST['username'],
                    'email' => strtolower($_POST['emailOrNumber']),
                    'password' => $password
                ]);

                if ($result) {

                    redirect('/users/success', true);
                } else {
                    flashMessage()->error(
                        'مشکلی در انجام عملیات در پایگاه داده بوجود آمده، اخطار های زیر را چک کنید و در صورت درستی با پشتیبانی تماس بگیرید.' .
                            '<ul><li>حتما چک کنید که فیلد ایمیل یا شماره تماس توسط شما یا شخص دیگری وارد نشده باشد.</li></ul>'
                    );

                    redirect('/users/register', true);
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
                $this->view('register');
            }
        } else {
            redirect_back();
        }
    }
}
