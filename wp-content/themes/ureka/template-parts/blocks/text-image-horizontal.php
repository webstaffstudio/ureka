<?php
/**
 * Block Name: Text Image Horizontal
 * Description: A block to showcase text and image in repeatable block
 * Icon: align-right  // Use a suitable Dashicons class like 'admin-users' or a custom SVG.
 * Keywords: about, company, team
 * Supports: { "align": ["wide", "full"], "anchor": true }
 */
$text_image_repeater = get_field('text_image_section_repeater');

if ($text_image_repeater):
    foreach ($text_image_repeater as $index => $row):
        $i_bg_class = ($index % 2 === 1) ? '' : ' bg-gray-lighter';
        $i_direction_class = ($index % 2 === 1) ? ' flex-xl-row-reverse' : '';
        $image_id = ($row['text_image_horiz_image']) ?? '';
        $section_bg_color = ($row['text_image_horiz_section_color']) ?? '';
        $title = ($row['text_image_horiz_title']) ?? '';
        $description = ($row['text_image_horiz_description']) ?? '';
        $text = ($row['text_image_horiz_text']) ?? '';
        $link = ($row['text_image_horiz_link']) ?? '';
        $is_pdf_file = ($row['is_pdf_file']) ?? '';
        $text_image_button_text = ($row['text_image_button_text']) ?? 'Завантажити';
        $pdf_file = ($row['pdf_file']) ?? '';
        if ($image_id || $title || $description || $text || $link): ?>
            <section class="text-image-horiz section-md<?= $i_bg_class; ?>" <?= $section_bg_color ? 'style="background-color:' . esc_attr($section_bg_color) . ';"' : '' ?>>
                <div class="container">
                    <div class="row justify-content-md-center row-30 row-md-50<?=$i_direction_class;?>">
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
                            <?php if ($link && !$is_pdf_file): ?>
                                <a class="button button-primary" href="<?= $link['url']; ?>"
                                   target="<?= $link['target']; ?>"><?= $link['title']; ?></a>
                            <?php endif; ?>
                        </div>
                        <?php if ($image_id): ?>
                            <div class="col-md-11 col-lg-10 col-xl-6">
                                <?= get_image_html($image_id, 'large', 'text-image-horiz-image', $title); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($is_pdf_file && $pdf_file): ?>
                            <div class="justify-content-md-center text-center">
                                <a class="button button-primary" href="<?= $pdf_file; ?>"
                                   target="_blank" download="">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    <span style="margin-left: 3px;"><?= $text_image_button_text; ?></span></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
