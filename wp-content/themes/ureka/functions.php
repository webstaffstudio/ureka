<?php
//Define text domain name
define('THEME_TD', 'ureka');
define('THEME_VER', '1.00');
define('THEME_ROOT', get_template_directory());
define('THEME_ROOT_URI', get_template_directory_uri());

// CPT
$post_types_directory = __DIR__ . '/configure/post-type/';

if (is_dir($post_types_directory)) {
    foreach (glob($post_types_directory . '*.php') as $file) {
        include $file;
    }
}

$directory = __DIR__ . '/configure/';

if (is_dir($directory)) {
    foreach (glob($directory . '*.php') as $file) {
        if (basename($file)) {
            include $file;
        }
    }
}

