<?php

namespace App\Controller;

use App\Helper\Validation;
use Carbon\Carbon;
use App\Model\User;

class Users extends Controller
{

    protected $user;

    public function __construct()
    {

        if (auth()->check()) {

            redirect();
        }

        $this->user = new User;
    }

    /**
     * register
     *
     * @return void
     */
    public function register()
    {

        if (request()->isPost()) {

            $this->submit();
        } else {

            $this->view('register');
        }
    }

    /**
     * success
     *
     * @return void
     */
    public function success()
    {
        $this->view('success');
    }

    /**
     * 
     *
     * @return void
     */
    public function login()
    {

        if (request()->isPost()) {

            $this->authorize();
        } else {

            $this->view('login');
        }
    }

    /**
     * =========================== PRIVATES ========================
     */
    /**
     * authorize
     *
     * @return void
     */
    private function authorize()
    {

        $rules = [
            'emailOrNumber' => 'required|emailnumber|mustExist:users__email',
            'password' => 'required',
        ];

        $validation = new Validation();

        $is_valid = $validation->make(request()->all(), $rules);

        if ($is_valid) {
            // need to authroize by password

            $user = $this->user->find('email', request('emailOrNumber'));
            if (password_verify(request('password'), $user->password)) {

                $remember = false;

                if (!empty(request('remember'))) {
                    $remember = true;
                }

                auth()->login($user, $remember);

                flashMessage()->success('با موفقیت وارد حساب کاربری خود شدید.');

                redirect();
            } else {

                flashMessage()->error('اطلاعات کاربری صحیح نیست.');
                $this->view('login');
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
            $this->view('login');
        }
    }

    /**
     * post request
     *
     * @return void
     */
    private function submit()
    {

        $rules = [
            'username' => 'required',
            'emailOrNumber' => 'required|emailnumber|unique:users__email',
            'password' => 'required|min:6',
            'password_confirm' => 'required|confirm:password',
        ];

        $validation = new Validation();

        $is_valid = $validation->make(request()->all(), $rules);
        if ($is_valid) {
            // user can submit
            $password = password_hash(request('password'), PASSWORD_BCRYPT);
            $email = strtolower(request('emailOrNumber'));
            // insert into db
            $result = $this->user->insert([
                'name' => request('username'),
                'email' => $email,
                'password' => $password,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if ($result) {

                flashMessage()->success('حساب کاربری شما با موفقیت ساخته شده است.');

                $user = (new User)->find('email', $email);

                auth()->login($user, false);

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
