<?php

get_head();
?>

<main>

    <div class="container">

        <?php if (flashMessage()->hasErrors()) : ?>
            <?php echo flashMessage()->display(); ?>
        <?php endif; ?>

        <div class="jumbotron text-center">
            سلام خوش آمدید.
        </div>

        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger">
                <?php print_array($errors); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo URL_ROOT; ?>/users/submit">

            <div class="form-group">
                <label for="username">نام و نام خانوادگی</label>
                <input id="username" name="username" class="form-control" value="<?= old('name'); ?>" type="text">
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

    </div>
</main>

<?php get_footer() ?>