<?php
/**
 * Block Name: Icon Box
 * Description: A versatile box block featuring an icon, title, and description, perfect for showcasing features or services.
 * Icon: info
 * Keywords: icon, box, feature, service
 * Supports: { "align": ["wide", "full"], "anchor": true }
 */
?>

<?php
$icon_box_title = get_field('icon_box_title');
$icon_boxes = get_field('icon_box');
if ($icon_boxes): ?>
    <section class="section-md bg-default text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?= ($icon_box_title) ? '<h4 class="heading-decorated">' . $icon_box_title . '</h4>' : ''; ?>
                </div>
            </div>
            <div class="row row-50 justify-content-md-center justify-content-lg-start">
                <?php foreach ($icon_boxes as $box):
                    $linear_icon = $box['icon'];
                    $title = $box['title'];
                    $text = $box['text'];
                    if (strpos($linear_icon, 'lnr-') === 0) {
                        $linear_icon = substr($linear_icon, 4);
                    }
                    ?>
                    <div class="col-md-6 col-xl-4">
                        <article class="blurb blurb-circle">
                            <div class="unit flex-column flex-sm-row unit-spacing-md">
                                <?php if ($linear_icon): ?>
                                    <div class="unit-left">
                                        <div class="blurb-circle__icon">
                                            <span class="icon linear-icon-<?= $linear_icon; ?>"></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="unit-body">
                                    <?= ($title) ? '<p class="heading-6 blurb__title">' . $title . '</p>' : ''; ?>
                                    <?= ($text) ? '<p>' . $text . '</p>' : ''; ?>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
