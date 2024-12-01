<?php
function register_ureka_products_post_type() {
    $labels = [
        'name'               => 'Products',
        'singular_name'      => 'Product',
        'menu_name'          => 'Products',
        'name_admin_bar'     => 'Product',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Product',
        'edit_item'          => 'Edit Product',
        'new_item'           => 'New Product',
        'view_item'          => 'View Product',
        'search_items'       => 'Search Products',
        'not_found'          => 'No Products found',
        'not_found_in_trash' => 'No Products found in Trash',
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => 'products',
        'rewrite'            => ['slug' => 'product'],
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'show_in_rest'       => true,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-cart',
    ];

    register_post_type('ureka-products', $args);
}
add_action('init', 'register_ureka_products_post_type');
