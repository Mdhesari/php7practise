<?php get_head(); ?>

<main>

    <div class="container">

        <?php if (flashMessage()->hasMessages()) : ?>
            <?php echo flashMessage()->display(); ?>
        <?php endif; ?>

        <div class="jumbotron text-center">
            ارسال مقاله جدید
        </div>

        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger">
                <?php print_array($errors); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo URL_ROOT; ?>/articles/create">

            <div class="form-group">

                <label for="title">موضوع</label>

                <input id="title" name="title" type="text" class="form-control">
            </div>

            <div class="form-group">

                <label for="description">متن</label>

                <textarea name="description" id="text" rows="10">

                </textarea>
            </div>

            <input class="btn btn-success" type="submit" value="ارسال">

        </form>

    </div>
</main>

<?php get_footer(); ?>