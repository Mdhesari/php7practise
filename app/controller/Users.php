<?php

namespace App\Controller;

use App\Helper\Validation;
use App\Model\User;
use \Plasticbrain\FlashMessages\FlashMessages;

class Users extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function register()
    {

        $flash = new FlashMessages;

        $flash->error('This is a error message.');

        $this->view('register');
    }

    public function submit()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $rules = [
                'username' => 'required',
                'emailOrNumber' => 'required|emailnumber',
                'password' => 'required',
                'password_confirm' => 'required|confirm:password',
            ];

            $validation = new Validation();

            $is_valid = $validation->make($_POST, $rules);

            if ($is_valid) {

                // user can submit
                $this->view('success');
            } else {

                // user's data is not validated
                $errors = $validation->getErrors();
                $this->view('register', compact('errors'));
            }
        } else {
            dd('hi');
        }
    }
}
