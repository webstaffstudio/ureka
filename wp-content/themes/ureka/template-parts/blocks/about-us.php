<?php
/**
 * Block Name: About Us
 * Description: A block to showcase information about the company or team.
 * Icon: admin-users  // Use a suitable Dashicons class like 'admin-users' or a custom SVG.
 * Keywords: about, company, team
 * Supports: { "align": ["wide", "full"], "anchor": true }
 */

$image_id = get_field('about_us_image');
$title = get_field('about_us_title');
$description = get_field('about_us_description');
$text = get_field('about_us_text');
$link = get_field('about_us_link');

if ($image_id || $title || $description || $text || $link): ?>
    <section class="about-us section-md bg-gray-lighter">
        <div class="container">
            <div class="row justify-content-md-center row-30 row-md-50">
                <div class="col-md-11 col-lg-10 col-xl-6">
                    <?php if ($title): ?>
                        <h4 class="heading-decorated"><?= $title; ?></h4>
                    <?php endif; ?>
                    <?php if ($description): ?>
                        <p class="heading-6 text-width-1"><?= $description; ?></p>
                    <?php endif; ?>
                    <?php if ($text): ?>
                        <p><?= $text; ?></p>
                    <?php endif; ?>
                    <?php if ($link): ?>
                        <a class="button button-primary" href="<?= $link['url']; ?>" target="<?= $link['target']; ?>"><?= $link['title']; ?></a>
                    <?php endif; ?>
                </div>
                <?php if ($image_id): ?>
                    <div class="col-md-11 col-lg-10 col-xl-6">
                        <?= get_image_html($image_id, 'thumbnail', 'about-us-image'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
