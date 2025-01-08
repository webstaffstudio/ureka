<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QWW6FFZ0PS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-QWW6FFZ0PS');
</script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site-page">

    <header id="masthead" class="site-header">
        <div class="rd-navbar-wrap">
            <?php if (has_nav_menu('menu-header')): ?>
                <nav class="rd-navbar rd-navbar_transparent rd-navbar_boxed visibility-hidden" data-layout="rd-navbar-fixed"
                     data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed"
                     data-lg-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static"
                     data-xl-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static"
                     data-xxl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static"
                     data-lg-stick-up="true"
                     data-xl-stick-up="true" data-xxl-stick-up="true" data-lg-stick-up-offset="35px"
                     data-xl-stick-up-offset="35px" data-xxl-stick-up-offset="35px"
                     data-body-class="rd-navbar-absolute">
                    <div class="rd-navbar-inner rd-navbar-search-wrap">
                        <div class="rd-navbar-panel rd-navbar-search-lg_collapsable">
                            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span>
                            </button>
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

                            <div class="rd-navbar-search rd-navbar-search_toggled rd-navbar-search_not-collapsable">
                                <form class="rd-search" action="<?= esc_url(home_url('/')); ?>" method="GET">
                                    <div class="form-wrap">
                                        <input class="form-input" id="rd-navbar-search-form-input"
                                               placeholder="<?= __('Введіть запит для пошуку', THEME_TD); ?>"
                                               type="text" name="s" autocomplete="off">
                                    </div>
                                    <button class="rd-search__submit" type="submit"></button>
                                </form>
                                <div class="rd-navbar-fixed--hidden">
                                    <button class="rd-navbar-search__toggle" data-custom-toggle=".rd-navbar-search-wrap"
                                            data-custom-toggle-disable-on-blur="true"></button>
                                </div>
                            </div>
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
                            <div class="rd-navbar__element rd-navbar-search_collapsable">
                                <button class="rd-navbar-search__toggle rd-navbar-fixed--hidden"
                                        data-rd-navbar-toggle=".rd-navbar-search-wrap"></button>
                            </div>
                        </div>
                    </div>
                </nav>
            <?php endif; ?>
        </div>
    </header><!-- #masthead -->


    <div id="content" class="site-content">
