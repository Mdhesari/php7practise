<?php

namespace App\Controller;

use App\Helper\Validation;
use Carbon\Carbon;
use App\Model\User;
use App\Model\DB;

class Users extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function register()
    {
        if (request()->isPost()) {

            $this->submit();
        } else {

            $this->view('register');
        }
    }

    public function success()
    {

        $this->view('success');
    }

    public function login()
    {
        if (request()->isPost()) {

            $this->authorize();
        } else {
            $this->view('login');
        }
    }

    private function authorize()
    {

        $rules = [
            'emailOrNumber' => 'required|emailnumber|mustExist:users__email',
            'password' => 'required',
        ];

        $validation = new Validation();

        $is_valid = $validation->make(request()->all(), $rules);

        if ($is_valid) {
            // true
            $user = $this->user->find('email', request('emailOrNumber'));

            
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
            $this->view('login');
        }
    }

    // post request
    private function submit()
    {

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
            $password = password_hash(request('password'), PASSWORD_BCRYPT);

            // insert into db
            $result = $this->user->insert([
                'name' => request('username'),
                'email' => strtolower(request('emailOrNumber')),
                'password' => $password,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if ($result) {

                flashMessage()->success('حساب کاربری شما با موفقیت ساخته شده است.');
                redirect();
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
    }
}
