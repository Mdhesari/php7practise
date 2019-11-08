<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pro OOP</title>

    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/resources/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT;  ?>/resources/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/resources/css/blog-home.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/resources/css/app.css">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo URL_ROOT; ?>">شی گرایی</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php if (auth()->check()) : ?>
                        <li>
                            <a class="btn" href="<?php echo URL_ROOT; ?>/users/logout"> خروج از حساب کاربری   <span>(<?php echo auth()->user()->name; ?>)</span></a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href="<?php echo URL_ROOT; ?>/users/login">ورود</a>
                        </li>
                        <li>
                            <a href="<?php echo URL_ROOT; ?>/users/register">ثبت نام</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>