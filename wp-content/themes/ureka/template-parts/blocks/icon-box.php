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
                    <?=($icon_box_title) ? '<h4 class="heading-decorated">'.$icon_box_title.'</h4>' : '';?>
                </div>
            </div>
            <div class="row row-50 justify-content-md-center justify-content-lg-start">
                <?php foreach ($icon_boxes as $box):
                    $icon = $box['icon'];
                    $title = $box['title'];
                    $text = $box['text'];
                    ?>
                    <div class="col-md-6 col-xl-4">
                        <article class="blurb blurb-circle">
                            <div class="unit flex-column flex-sm-row unit-spacing-md">
                                <div class="unit-left">
                                    <div class="blurb-circle__icon">
                                        <?= get_image_html($icon, 'medium', '', $title); ?>
                                    </div>
                                </div>
                                <div class="unit-body">
                                    <?=($title) ? '<p class="heading-6 blurb__title">'.$title.'</p>' : '';?>
                                    <?=($text) ? '<p>'.$text.'</p>' : '';?>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
