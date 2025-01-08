<?php
/**
 * Block Name: Welcome
 * Description: A customizable block for displaying welcome slider section with a background, title, description, and optional button.
 * Icon: admin-users
 * Keywords: welcome, intro, section
 * Supports: {"align":true,"mode":false,"multiple":true}
 */

$slides = get_field('welcome_slides');

if ($slides): ?>

    <section class="welcome">
        <div class="swiper-container swiper-slider swiper-slider_fullheight bg-gray-dark"
             data-simulate-touch="false"
             data-loop="true">
            <div class="swiper-wrapper">
                <?php foreach ($slides as $index => $slide):
                $image = !empty($slide['image']) ? wp_get_attachment_image_src($slide['image'], 'optimized_2k')[0] : '';
                $title = $slide['title'] ?? '';
                $text = $slide['text'] ?? '';
                $link = $slide['link'] ?? '';
                ?>
                <div class="swiper-slide text-center" <?= $image ? 'data-slide-bg="' . esc_attr($image) . '"' : ''; ?>>
                    <div class="swiper-slide-caption">
                        <div class="container">
                            <div class="row justify-content-lg-center">
                                <div class="col-lg-10">
                                    <?php if ($title): ?>
                                    <<?= $index === 0 ? 'h1' : 'h2'; ?>
                                    class="welcome__heading heading-decorated">
                                    <?= esc_html($title); ?>
                                </<?= $index === 0 ? 'h1' : 'h2'; ?>>
                                <?php endif; ?>
                                <?php if ($text): ?>
                                    <h4>
                                        <?= esc_html($text); ?>
                                    </h4>
                                <?php endif; ?>
                                <?php if ($link): ?>
                                    <a class="button button-primary"
                                       href="<?= esc_url($link['url']); ?>">
                                        <?= esc_html($link['title']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev linear-icon-chevron-left"></div>
        <div class="swiper-button-next linear-icon-chevron-right"></div>
        </div>
    </section>
<?php endif; ?>
