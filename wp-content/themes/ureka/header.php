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
        <div class="rd-navbar-wrap">
            <?php if (has_nav_menu('menu-header')): ?>
                <nav class="rd-navbar rd-navbar_transparent rd-navbar_boxed" data-layout="rd-navbar-fixed"
                     data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed"
                     data-lg-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static"
                     data-xl-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static"
                     data-xxl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static"
                     data-lg-stick-up="true"
                     data-xl-stick-up="true" data-xxl-stick-up="true" data-lg-stick-up-offset="35px"
                     data-xl-stick-up-offset="35px" data-xxl-stick-up-offset="35px"
                     data-body-class="rd-navbar-absolute">
                    <div class="rd-navbar-inner">
                        <div class="rd-navbar-panel rd-navbar-search-lg_collapsable">
                            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span>
                            </button>
                            <!-- RD Navbar Brand-->
                            <div class="rd-navbar-brand">
                                <?php if (get_field('site_logo', 'options')): ?>
                                    <a class="brand-name" href="<?= site_url(); ?>">
                                        <img src="<?php the_field('site_logo', 'options'); ?>" alt="ureka-logo"/>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <?= ureka_display_lang_switcher(); ?>
                        </div>
                        <div class="rd-navbar-nav-wrap rd-navbar-search_not-collapsable">
                            <div class="rd-navbar-search_collapsable">
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'menu-header',
                                    'menu_id' => 'menu-header',
                                    'menu_class' => 'rd-navbar-nav',
                                    'container' => false,
                                    'walker' => new Ureka_Walker_Nav_Menu(),
                                ));
                                ?>
                            </div>
                            <?= ureka_display_lang_switcher(); ?>
                        </div>
                    </div>
                </nav>
            <?php endif; ?>
        </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content">
