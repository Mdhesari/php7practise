<?php

namespace App\Controller;

use App\Helper\Validation;

class Users extends Controller
{

    public function register()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') :

            $rules = [
                'username' => 'required',
                'emailOrNumber' => 'required',
                'password' => 'required',
                'password_confirm' => 'required|confirm:password',
            ];

            $validation = new Validation();

            $is_valid = $validation->make($_POST, $rules);

            if($is_valid){
                // user can submit
                echo 'true';

            } else {
                // user's data is not validated

                echo 'false';

            }

        else :
            ?>

            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                <div class="form-group">
                    <label for="username">نام و نام خانوادگی</label>
                    <input id="username" name="username" class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label for="emailOrNumber">ایمیل یا شماره همراه</label>
                    <input id="emailOrNumber" name="emailOrNumber" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">رمز</label>
                    <input id="password" name="password" type="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password_confirm">تکرار رمز</label>
                    <input id="password_confirm" name="password_confirm" type="password" class="form-control">
                </div>

                <input type="submit" value="ثبت نام">

            </form>

<?php
        endif;
    }

    public function actionRegister()
    { }
}
