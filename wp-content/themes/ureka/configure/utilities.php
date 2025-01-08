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
    $full_path = $theme_path . '/' . '/assets/src/img/' . $image_name.'.svg';

    if (file_exists($full_path)) {
        return file_get_contents($full_path);
    } else {
        return '';
    }
}


function get_bootstrap_grid_class($acf_value, $mobile_class = 'col-xs-12')
{
        $class = $acf_value.'_set ';
    switch ($acf_value) {
        case 'col_1':
            $grid_class = $class.'col-md-12';
            break;
        case 'col_2':
            $grid_class = $class.'col-md-6';
            break;
        case 'col_3':
            $grid_class = $class.'col-xl-4 col-md-6';
            break;
        case 'col_4':
            $grid_class = $class.'col-md-6';
            break;
        default:
            $grid_class = 'col_1_set col-md-12';
    }


    return $grid_class . ' ' . $mobile_class;
}
