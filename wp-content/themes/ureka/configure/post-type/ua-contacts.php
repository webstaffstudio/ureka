<?php

function register_ureka_ua_contacts_post_type()
{
    $labels = [
        'name' => 'Contacts',
        'singular_name' => 'Contact',
        'menu_name' => 'Contacts',
        'name_admin_bar' => 'Contact',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Contact',
        'edit_item' => 'Edit Contact',
        'new_item' => 'New Contact',
        'view_item' => 'View Contact',
        'search_items' => 'Search Contacts',
        'not_found' => 'No Contacts found',
        'not_found_in_trash' => 'No Contacts found in Trash',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => 'ua-contacts',
        'supports' => ['title','custom-fields'],
        'show_in_rest' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-phone',
    ];

    register_post_type('ua-contacts', $args);
}

add_action('init', 'register_ureka_ua_contacts_post_type');
