<?php

// Utilities functions here

function get_image_html($image_id, $size = 'full', $class = '', $alt = '', $loading = '')
{
    if (!$image_id) return '';

    $image = wp_get_attachment_image_src($image_id, $size);
    if (!$image) return '';

    $srcset = wp_get_attachment_image_srcset($image_id, $size);

    // Determine alt text priority: argument > alt from meta > title
    $alt_text = $alt ?: get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: get_the_title($image_id);

    // Construct additional attributes
    $loading_attr = $loading === 'lazy' ? ' loading="lazy"' : '';

    return sprintf(
        '<img src="%s" alt="%s" srcset="%s" class="%s"%s>',
        esc_url($image[0]),
        esc_attr($alt_text),
        esc_attr($srcset),
        esc_attr($class),
        $loading_attr
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


