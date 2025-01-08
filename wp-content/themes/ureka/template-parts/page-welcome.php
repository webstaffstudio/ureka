<?php
$page_welcome = get_field('page_welcome');
$hero_image = $page_welcome['page_welcome_image'] ?? '';
if (!$hero_image) {
    $hero_image = get_field('page_welcome_image', 'options');
}
$hero_image_url = $hero_image ? wp_get_attachment_image_src($hero_image, 'large')[0] : '';
$page_title = get_the_title();
$page_description = $page_welcome['page_description'] ?? '';
$show_breadcrumbs = true;
if (!empty($_GET['s'])) {
    $page_title = __('Результати пошуку за словом: '. $_GET['s'], THEME_TD);
    $page_description = '';
    $show_breadcrumbs = false;
    $home_btn = true;
}
?>
<section class="page-welcome text-center">
    <div class="section parallax-container" <?= ($hero_image_url) ? 'data-parallax-img="' . $hero_image_url . '"' : ''; ?>>
        <?php if ($hero_image_url): ?>
            <div class="material-parallax parallax">
                <img src="<?= $hero_image_url; ?>" alt="<?= $page_title ?>"
                     style="display: block; transform: translate3d(-50%, 179px, 0px);">
            </div>
        <?php endif; ?>
        <div class="parallax-content parallax-header parallax-light">
            <div class="parallax-header__inner">
                <div class="parallax-header__content">
                    <div class="container">
                        <div class="row justify-content-sm-center">
                            <div class="col-md-10">
                                <h1 class="heading-decorated"><?= $page_title ?></h1>
                                <?= ($page_description) ? '<p class="heading-6">' . $page_description . '</p>' : ''; ?>
                                <?php if ($show_breadcrumbs && function_exists('bcn_display')): ?>
                                    <div class="page-welcome__nav">
                                        <?php bcn_display(); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($home_btn)):?>
                                    <a href="<?= site_url();?>" class="button button-primary"><?=__('На головну', THEME_TD);?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
