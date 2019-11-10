<?php get_head(); ?>

<main>
    <div class="container">
        <div class="jumbotron">
            <h1>
                <?php echo $article->title; ?>
            </h1>
            <div class="meta my-2">
                <span> <?php echo $article->created_at; ?> </span>
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