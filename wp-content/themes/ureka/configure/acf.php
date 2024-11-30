<?php

// ACF functions here
//Register Options Page
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => __('Theme Settings', THEME_TD),
        'menu_title'    => __('Theme Settings', THEME_TD),
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

}

if (function_exists('acf_register_block')) {

    add_action('block_categories_all', function ($categories) {
        return array_merge(
            [
                [
                    'slug' => 'ureka',
                    'title' => __('Ureka', THEME_TD),
                ],
            ],
            $categories
        );
    });

    add_action('acf/init', function () {
        $blockFiles = new DirectoryIterator(locate_template('template-parts/blocks/'));

        foreach ($blockFiles as $file) {
            if ($file->isDot() || $file->getExtension() !== 'php') {
                continue;
            }

            $blockName = $file->getBasename('.php');
            $blockSlug = 'ureka_' . $blockName;
            $blockPath = 'template-parts/blocks/' . $blockName . '.php';

            $blockOptions = get_file_data(locate_template($blockPath), [
                'title' => 'Block Name',
                'desc' => 'Description',
                'icon' => 'Icon', // Include icon in the options
                'keywords' => 'Keywords',
                'supports' => 'Supports',
            ]);

            acf_register_block_type([
                'name' => $blockSlug,
                'title' => $blockOptions['title'] ?: __('Unnamed Block:', THEME_TD) . ' ' . $blockName,
                'description' => $blockOptions['desc'] ?? '',
                'category' => 'ureka',
                'icon' => $blockOptions['icon'] ?? 'admin-generic', // Use the icon from the options
                'keywords' => isset($blockOptions['keywords']) ? explode(' ', $blockOptions['keywords']) : '',
                'supports' => isset($blockOptions['supports']) ? json_decode($blockOptions['supports'], true) : '',
                'render_template' => $blockPath,
                'mode' => 'edit',
            ]);
        }
    });


    add_filter('render_block', function ($block_content, $block) {
        if (empty($block_content)) return $block_content;

        ob_start();
        wp_print_styles($block['blockName']);
        return ob_get_clean() . $block_content;
    }, 10, 3);
}
