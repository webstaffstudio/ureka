<?php

get_header();
$hero_image = $page_welcome['page_welcome_image'] ?? '';
if (!$hero_image) {
    $hero_image = get_field('page_welcome_image', 'options');
}
$hero_image_url = $hero_image ? wp_get_attachment_image_src($hero_image, 'large')[0] : '';
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <section class="page-welcome text-center">
            <div class="bg-gray-dark text-center">
                <section class="section parallax-container"  <?= ($hero_image_url) ? 'data-parallax-img="' . $hero_image_url . '"' : ''; ?>>
                    <div class="parallax-content parallax-header parallax-light">
                        <div class="parallax-header__inner">
                            <div class="parallax-header__content">
                                <div class="container">
                                    <div class="row justify-content-sm-center">
                                        <div class="col-md-10 col-xl-8">
                                            <h2>Page Not Found</h2>
                                            <p>The page requested couldn't be found - this could be due to a spelling error in the URL or a removed page.</p><a class="button button-primary" href="<?= site_url();?>">Go back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            </section>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
