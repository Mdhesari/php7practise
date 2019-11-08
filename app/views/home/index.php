<?php get_head(); ?>

<main>
    <h1 class="display-1 text-center">خوش آمدید.</h1>

    <div class="container">

        <?php if (flashMessage()->hasMessages()) : ?>
            <?php echo flashMessage()->display(); ?>
        <?php endif; ?>

        <section>
            <div class="btn-group">
                <?php if (auth()->check()) : ?>
                <a href="<?php echo URL_ROOT; ?>/users/dashboard" class="btn btn-primary">پنل کاربری</a>
                <?php else : ?>
                    <a href="<?php echo URL_ROOT; ?>/users/login" class="btn btn-secondary">ورود</a>
                    <a href="<?php echo URL_ROOT; ?>/users/register" class="btn btn-secondary">ثبت نام</a>
                <?php endif; ?>
            </div>
        </section>
    </div>

</main>

<?php get_footer(); ?>