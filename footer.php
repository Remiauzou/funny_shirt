<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="logo">
                    <?php the_custom_logo(); ?>
                    <div class="titleFooter">
                        <h1 style="color: white"><?= bloginfo('name'); ?></h1>
                        <p><?= bloginfo('description'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php dynamic_sidebar('center-footer') ?>
            </div>
            <div class="col-md-4">
                <div class="center">
                    <h3 class="titleFooter"> Coordonnées :</h3>
                    <p>Adresse : <?= carbon_get_theme_option('siteadress'); ?></p>
                    <p>Téléphone : <?= carbon_get_theme_option('telephone'); ?></p>
                    <p>Email : <?= carbon_get_theme_option('email'); ?></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
