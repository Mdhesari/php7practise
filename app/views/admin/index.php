<?php get_head(); ?>

<main>
    <div class="container">

        <section class="profile">

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">اطلاعات کاربران</div>

                <?php if (count($users) > 0) : ?>
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
                            <?php foreach ($users as $user) : ?>
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
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                <div class="alert alert-warning">
                    هیچ کاربری وجود ندارد.
                </div>
                <?php endif; ?>
            </div>

        </section>

        <!-- <section class="articles">

            <h3>مقاله ها</h3>

            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="..." alt="...">
                        <div class="caption">
                            <h3>Thumbnail label</h3>
                            <p>...</p>
                            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                        </div>
                    </div>
                </div>
            </div>


        </section> -->

    </div>
</main>

<?php get_footer(); ?>