<?php

// Utilities functions here

function get_image_html($image_id, $size = 'full', $class = '', $alt = '', $loading = '')
{
    if (!$image_id) return '';

    return wp_get_attachment_image(
        $image_id,
        $size,
        false, // No icon
        [
            'class' => $class,
            'alt' => $alt ?: get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: get_the_title($image_id),
            'loading' => $loading === 'lazy' ? 'lazy' : '',
        ]
    );
}


// Show formatted object or array
function debug($data, $write_in_log = false)
{
    @ini_set('display_errors', 0);

    if ($write_in_log) {
        echo '<pre>' . error_log(print_r($data, true)) . '</pre>';
    } else {
        echo '<pre>' . print_r($data, true) . '</pre>';
    }
}

// Display svg element
function get_svg_image($image_name)
{
    $theme_path = get_template_directory();
    $full_path = $theme_path . '/' . '/assets/src/img/' . $image_name;

    if (file_exists($full_path)) {
        return file_get_contents($full_path);
    } else {
        return '';
    }
}
