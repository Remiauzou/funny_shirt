<?php
$mag_query = new WP_Query([
    'post_type' => 'magasin',
    'post_per_page' => 3
]);

$product_query = new WP_Query([
    'post_type' => 'product',
    'post_per_page' => 3
]);

$places = get_terms([
    'taxonomy' => 'magasin',
    'hide_empty' => false
]);

$slider = new WP_Query([
    'post_type' => 'slider',
    'posts_per_page' => 2,
]);

get_header();
?>

    <main class="container">

        <div class="row">
            <div class="container-fluid slider-front">
                <?php if ($slider->have_posts()) : while ($slider->have_posts()) : $slider->the_post(); ?>
                    <div class="slide"
                         style="background-image: url('<?= the_post_thumbnail_url($slider, 'full'); ?>');">
                        <div class="container slideHeigth">
                            <div class="row slideHeigth">
                                <div class="content-<?= carbon_get_the_post_meta('css_side') ?>">
                                    <div class="contentAlign">
                                        <h2><?= the_title() ?></h2>
                                        <?php if (carbon_get_the_post_meta('description')): ?>
                                            <p class="descriptionSlider"> <?= carbon_get_the_post_meta('description'); ?></p>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; else : ?>

                <?php endif; ?>
            </div>
            <h2> <?= carbon_get_theme_option('title'); ?> </h2>
            <p> <?= carbon_get_theme_option('description'); ?></p>
            <div class="col-md-12">
                <h2> <?= carbon_get_theme_option('title-actu'); ?></h2>
                <div class="articles">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <article class="card post-card col-one-third">
                            <div class="card-content m-3">
                                <img class="picture" src="<?php the_post_thumbnail_url('medium'); ?>" alt="">
                                <div class="card-body">
                                    <h1><?php the_title(); ?></h1>
                                    <?php the_content(); ?>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn">Lire la suite</a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; else : ?>

                        <p>Pas d'articles pour le moment</p>
                    <?php endif; ?>
                </div>
                <div class="container">
                    <h2> <?= carbon_get_theme_option('title-mag'); ?></h2>
                    <div class="mag">
                        <?php if ($mag_query->have_posts()) : while ($mag_query->have_posts()) : $mag_query->the_post(); ?>
                            <article>
                                <?php the_post_thumbnail('medium'); ?><br>
                                <?php the_title(); ?><br>
                                <?php $places = get_the_terms(get_the_ID(), 'place'); ?>

                                <?php if ($places): ?>
                                    <ul>
                                        <?php foreach ($places as $place) : ?>
                                            <li><?= $place->name; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                                <a href="#" class="btn">Voir plus</a>
                            </article>
                        <?php endwhile; else : ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php wp_reset_postdata(); ?>

            </div>

            <div class="container">
                <h2> <?= carbon_get_theme_option('ventes'); ?></h2>
                <div class="mag">
                    <?php if ($product_query->have_posts()) : while ($product_query->have_posts()) : $product_query->the_post(); ?>
                        <article class="card post-card col-one-third">
                            <div class="card-content">
                                <?php the_post_thumbnail('medium'); ?><br>
                                <?php the_title(); ?>
                                <?php $product = wc_get_product(get_the_ID()); ?>
                                <h3><?= $product->get_price(); ?> €</h3>
                                <a href="#" class="btn">Ajouter au panier</a>
                            </div>
                        </article>
                    <?php endwhile; else : ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

<?php get_footer();