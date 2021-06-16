<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('after_setup_theme', function () {
    require_once('vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
});

add_action('carbon_fields_register_fields', function () {

    Container::make('theme_options', __('Options du thème'))
        ->add_tab('Contact', [
            Field::make_text('email', 'Email')->set_attribute('type', 'email'),
            Field::make_text('phone', 'Téléphone'),
        ]);

});

add_action('carbon_fields_register_fields', function () {
    Container::make('theme_options', 'Coordonnées')
        ->add_fields(array(
            Field::make('text', 'siteadress', 'Adresse'),
            Field::make('text', 'telephone', 'Téléphone du site'),
            Field::make('text', 'email', 'Email du site'),
        ));
    Container::make('theme_options', 'Page d\'accueil')
        ->add_fields(array(
            Field::make('text', 'title', 'Titre de la page'),
            Field::make('text', 'description', 'Description'),
            Field::make('text', 'title-actu', 'Titre des actus'),
            Field::make('text', 'title-mag', 'Titre des magasins'),
            Field::make('text', 'title-sell', 'Titre meilleures ventes'),
        ));
});

add_action('wp_enqueue_scripts', 'fromscratch_enqueue_scripts');
function fromscratch_enqueue_scripts()
{
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', [], wp_get_theme()->get('Version'));
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css', ['bootstrap'], wp_get_theme()->get('Version'));
    wp_enqueue_script('slick', get_template_directory_uri() . '/node_modules/slick-carousel/slick/slick.min.js', ['jquery'], _S_VERSION, true);
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', ['slick'], _S_VERSION, true);
}

add_action('after_setup_theme', 'fromscratch_after_setup_theme');
function fromscratch_after_setup_theme()
{
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

    add_theme_support('html5'); // Support de HTML5
    add_theme_support('title-tag'); // Balise title dans le head
    add_theme_support('post-thumbnails'); // Image mise en avant
    add_theme_support(
        'custom-logo',
        array(
            'height' => 100,
            'width' => 100,
            'flex-width' => true,
            'flex-height' => true,
        )
    );

    // Déclaration des menus (pour l'administration)
    register_nav_menu('menu-top', 'Menu en haut de page');
    register_nav_menu('menu-footer', 'Menu en pied de page');
}

add_action('init', 'fromscratch_init');
function fromscratch_init()
{
    register_post_type('magasin', [
        'labels' => ['name' => 'Magasins', 'singular_name' => 'Magasin', 'menu_name' => 'Magasins'],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'magasin'],
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
    ]);
}

register_taxonomy('place', ['magasin'], [
    'labels' => [
        'name'              => _x( 'Villes', 'taxonomy general name', 'funnyshirt' ),
        'singular_name'     => _x( 'Ville', 'taxonomy singular name', 'funnyshirt' ),
        'search_items'      => __( 'Rechercher Villes', 'funnyshirt' ),
        'all_items'         => __( 'Toutes les Villes', 'funnyshirt' ),
        'parent_item'       => __( 'Ville Parent', 'funnyshirt' ),
        'parent_item_colon' => __( 'Ville Parent :', 'funnyshirt' ),
        'edit_item'         => __( 'Modifier Ville', 'funnyshirt' ),
        'update_item'       => __( 'Mettre à jour Ville', 'funnyshirt' ),
        'add_new_item'      => __( 'Ajouter Nouvelle Ville', 'funnyshirt' ),
        'new_item_name'     => __( 'Nom de la nouvelle Ville', 'funnyshirt' ),
        'menu_name'         => __( 'Ville', 'funnyshirt' ),
    ],
    'hierarchical' => false,
    'rewrite' => ['slug' => 'ville']
]);

add_action('init', function () {
    register_post_type('slider', [
        'labels' => [
            'name' => _x('Sliders', 'Post type general name', ''),
            'singular_name' => _x('Slider', 'Post type singular name', 'funnyshirt'),
            'menu_name' => _x('Sliders', 'Admin Menu text', 'funnyshirt'),
            'name_admin_bar' => _x('Slider', 'Add New on Toolbar', 'funnyshirt'),
            'add_new' => __('Ajouter Nouveau', 'funnyshirt'),
            'add_new_item' => __('Ajouter Nouveau Slider', 'funnyshirt'),
            'new_item' => __('Nouveau Slider', 'funnyshirt'),
            'edit_item' => __('Modifier Slider', 'funnyshirt'),
            'view_item' => __('Voir Slider', 'funnyshirt'),
            'all_items' => __('Tous les Sliders', 'funnyshirt'),
            'search_items' => __('Recherché Sliders', 'funnyshirt'),
            'parent_item_colon' => __('Sliders Parent :', 'funnyshirt'),
            'not_found' => __('Sliders introuvable.', 'funnyshirt'),
            'not_found_in_trash' => __('Sliders introuvables dans la corbeille.', 'funnyshirt'),
            'featured_image' => _x('Photo de l\'Slider', 'Overrides the "Featured Image" phrase for this post type. Added in 4.3', 'funnyshirt'),
            'set_featured_image' => _x('Définir la photo', 'Overrides the "Set featured image" phrase for this post type. Added in 4.3', 'funnyshirt'),
            'remove_featured_image' => _x('Supprimer la photo', 'Overrides the "Remove featured image" phrase for this post type. Added in 4.3', 'funnyshirt'),
            'use_featured_image' => _x('Utiliser comme photo', 'Overrides the "Use as featured image" phrase for this post type. Added in 4.3', 'funnyshirt'),
            'archives' => _x('Slider archives', 'The post type archive label used in nav menus. Default "Post Archives". Added in 4.4', 'funnyshirt'),
            'insert_into_item' => _x('Insérer dans Slider', 'Overrides the "Insert into post"/"Insert into page" phrase (used when inserting media into a post). Added in 4.4', 'funnyshirt'),
            'uploaded_to_this_item' => _x('Uploadé à ce Slider', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase (used when viewing media attached to a post). Added in 4.4', 'funnyshirt'),
            'filter_items_list' => _x('Filtrer la liste des Sliders', 'Screen reader text for the filter links heading on the post type listing screen. Default "Filter posts list"/"Filter pages list". Added in 4.4', 'funnyshirt'),
            'items_list_navigation' => _x('Sliders navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default "Posts list navigation"/"Pages list navigation". Added in 4.4', 'funnyshirt'),
            'items_list' => _x('Sliders liste', 'Screen reader text for the items list heading on the post type listing screen. Default "Posts list"/"Pages list". Added in 4.4', 'funnyshirt'),
        ],
        'show_in_menu' => true,
        'public' => true,
        'supports' => ['title', 'thumbnail'],
        'rewrite' => ['slug' => 'slider'],
        'menu_icon' => 'dashicons-buddicons-buddypress-logo'
    ]);
});


add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['webp'] = 'image/webp';
    return $mimes;
});

