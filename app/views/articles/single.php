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
        </div>
    </div>
</main>

<?php get_footer(); ?>