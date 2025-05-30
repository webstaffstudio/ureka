<?php

function _add_javascript()
{
    // force all scripts to load in footer
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);

    // Deregister jQuery
    wp_deregister_script('jquery');
    wp_enqueue_script('cdn-jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), null, true);
    wp_enqueue_script('core', get_template_directory_uri() . '/assets/src/js/core/core.min.js', null, null, true);
    wp_enqueue_script('theme', get_template_directory_uri() . '/assets/dist/js/main.js', null, THEME_VER, true);

//    wp_localize_script('theme', 'themeVars', array(
//        'ajax_url' => admin_url('admin-ajax.php'),
//        'nonce' => wp_create_nonce('my_nonce_action'),
//    ));

}

add_action('wp_enqueue_scripts', '_add_javascript', 100);


function _add_stylesheets()
{
    // removing all WP css files enqueued by default
//    wp_dequeue_style('wp-block-library');
//    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
//    wp_dequeue_style('global-styles');
//    wp_dequeue_style('classic-theme-styles');

    wp_enqueue_style('theme', get_template_directory_uri() . '/assets/dist/css/main.css', null, THEME_VER, 'all');
}

add_action('wp_enqueue_scripts', '_add_stylesheets');
