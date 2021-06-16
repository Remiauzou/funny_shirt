<?php
// Template Name: Contact

get_header();
?>

    <main class="container">
        <h2>Contactez-nous</h2>
        <div class="row">
            <?php echo do_shortcode('[contact-form-7 id="49" title="Contactez nous"]'); ?>
            <div class="col-md-4">

                <div class="card">
                    <h5 class="card-header">Informations de contact</h5>
                    <div class="card-body">
                        <ul>
                            <li>
                                <a href="tel:<?= carbon_get_theme_option('phone'); ?>">
                                    <?= carbon_get_theme_option('phone'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:<?= carbon_get_theme_option('email'); ?>">
                                    <?= carbon_get_theme_option('email'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </main>

<?php get_footer();