<?php
$hero_image = get_field('page_welcome_image');
if (!$hero_image) {
$hero_image = get_field('page_welcome_image', 'options');
}
$hero_image_url = $hero_image ? wp_get_attachment_image_src($hero_image, 'large')[0] : '';
$page_description = get_field('page_description');
?>
<section class="page-welcome text-center">
    <div class="section parallax-container" <?= ($hero_image_url) ? 'data-parallax-img="' . $hero_image_url . '"' : ''; ?>>
        <?php if ($hero_image_url): ?>
            <div class="material-parallax parallax">
                <img src="<?= $hero_image_url; ?>" alt="<?php the_title(); ?>"
                     style="display: block; transform: translate3d(-50%, 179px, 0px);">
            </div>
        <?php endif; ?>
        <div class="parallax-content parallax-header parallax-light">
            <div class="parallax-header__inner">
                <div class="parallax-header__content">
                    <div class="container">
                        <div class="row justify-content-sm-center">
                            <div class="col-md-10 col-xl-8">
                                <h1 class="heading-decorated"><?php the_title(); ?></h1>
                                <?= ($page_description) ? '<p class="heading-6">' . $page_description . '</p>' : ''; ?>
                                <?php if (function_exists('bcn_display')): ?>
                                    <div class="page-welcome__nav">
                                        <?php bcn_display(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
