<?php get_head(); ?>

<main>
    <div class="container">

        <section class="profile">

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">اطلاعات کاربری من</div>

                <!-- Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>وضعیت حساب کاربری</th>
                            <th>نوع حساب کاربری</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $user->name; ?>
                            </td>

                            <td>
                                <?php echo $user->email; ?>
                            </td>

                            <td>
                                <?php echo $user->email_verified_at === null ? 'تایید نشده است.' : 'تایید شده است.'; ?>
                            </td>

                            <td>
                                <?php echo get_user_type($user->type); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </section>

        <section class="articles">

            <h3>مقاله های من</h3>

            <div class="my-3">
                <a class="btn btn-primary" href="<?php echo URL_ROOT; ?>/articles/create">ارسال مقاله جدید</a>
            </div>

            <div class="row">
                <?php foreach ($articles as $article) : ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <h3><?php echo $article->title; ?></h3>
                                <p><?php echo $article->body; ?> </p>
                                <p><a href="<?php echo URL_ROOT; ?>/articles/show/<?php echo $article->slug; ?>" class="btn btn-primary" role="button">ادامه مطلب</a></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


        </section>

    </div>
</main>

<?php get_footer(); ?>