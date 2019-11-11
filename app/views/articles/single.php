<?php

use \Morilog\Jalali\Jalalian;

get_head(); ?>

<main>
    <div class="container">

        <?php if (flashMessage()->hasMessages()) : ?>
            <?php echo flashMessage()->display(); ?>
        <?php endif; ?>

        <div class="jumbotron">
            <h1>
                <?php echo $article->title; ?>
            </h1>
            <div class="meta my-2">
                <p>
                    <strong>انتشار شده در</strong>
                    <?php echo Jalalian::forge($article->created_at)->ago(); ?>
                </p>
                <p>
                    <strong>بروز رسانی شده در</strong>
                    <?php echo Jalalian::forge($article->updated_at)->ago(); ?>
                </p>
                <p>
                    <strong>نویسنده</strong>
                    <span> <?php echo $author->name; ?> </span>
                </p>
            </div>
        </div>

        <div>
            <p>
                <?php echo $article->body; ?>
            </p>
            <div class="meta">
                <?php if (auth()->user()->id == $article->user_id) : ?>
                    <form method="post" action="<?php echo URL_ROOT; ?>/articles/delete/<?php echo $article->id; ?>" class="my-1">
                        <button type="submit" class="btn btn-outline-danger">حذف</button>
                    </form>
                    <a href="<?php echo URL_ROOT; ?>/articles/edit/<?php echo $article->id; ?>" class="btn btn-primary">ویرایش</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>