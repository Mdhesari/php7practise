<?php get_head(); ?>

<main>
    <div class="container">

        <section class="articles">

            <div class="my-3">
                <h3>مقاله ها</h3>

                <a class="btn btn-primary" href="<?php echo URL_ROOT; ?>/articles/create">ارسال مقاله جدید</a>

            </div>

            <?php if (count($articles) > 0) : ?>

                <div class="row">

                    <?php foreach ($articles as $article) : ?>

                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <!-- <img src="..." alt="..."> -->
                                <div class="caption">
                                    <h3>
                                        <?php echo $article->title; ?>
                                    </h3>
                                    <p>
                                        <?php echo $article->body; ?>
                                    </p>

                                    <p><a href="<?php echo URL_ROOT; ?>/articles/show/<?php echo $article->slug; ?>" class="btn btn-outline-primary" role="button">ادامه مطلب</a></p>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>
            <?php else : ?>

                <div class="alert alert-warning">هیچ مقاله ای وجود ندارد.</div>
            <?php endif; ?>

        </section>

    </div>
</main>

<?php get_footer(); ?>