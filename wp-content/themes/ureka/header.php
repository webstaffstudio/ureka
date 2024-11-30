<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site-page">
    <header id="masthead" class="site-header">
        <?php
        $site_logo = get_field('site_logo', 'options');
        if ($site_logo): ?>
            <img src="<?= $site_logo; ?>" alt="logo" />
        <?php endif; ?>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'menu-header',
            'menu_id' => 'menu-header',
            'container' => false,
            'walker' => new Ureka_Walker_Nav_Menu(),
        ));
        ?>
    </header><!-- #masthead -->

    <div id="content" class="site-content">
