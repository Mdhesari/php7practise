<?php

namespace App\Controller;

use App\Helper\Validation;

class Users extends Controller
{

    public function register()
    {

        $this->view('register');
    }

    public function submit()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $rules = [
                'usernamed' => 'required',
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
