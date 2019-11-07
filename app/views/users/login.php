<?php

get_head();
?>

<main>

    <div class="container">

        <?php if (flashMessage()->hasMessages()) : ?>
            <?php echo flashMessage()->display(); ?>
        <?php endif; ?>

        <div class="jumbotron text-center">
            ورود کاربران
        </div>

        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger">
                <?php print_array($errors); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo URL_ROOT; ?>/users/login">

            <div class="form-group">
                <label for="emailOrNumber">ایمیل یا شماره همراه</label>
                <input id="emailOrNumber" name="emailOrNumber" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">رمز</label>
                <input id="password" name="password" type="password" class="form-control">
            </div>


            <input type="submit" value="ورود">

        </form>

    </div>
</main>

<?php get_footer() ?>