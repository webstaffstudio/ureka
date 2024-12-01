<?php
/**
 * Block Name: Welcome
 * Description: A customizable block for displaying welcome slider section with a background, title, description, and optional button.
 * Icon: admin-users
 * Keywords: welcome, intro, section
 * Supports: {"align":true,"mode":false,"multiple":true}
 */

$slides = get_field('welcome_slides');
$welcome_link = get_field('welcome_link');

if ($slides): ?>
    <section class="welcome">
        <div class="swiper-container swiper-slider swiper-slider_fullheight bg-gray-dark"
             data-simulate-touch="false"
             data-loop="true"
             data-autoplay="5500">
            <div class="swiper-wrapper">
                <?php foreach ($slides as $index => $slide):
                $image = $slide['image'] ?? '';
                $title = $slide['title'] ?? '';
                $text = $slide['text'] ?? '';
                ?>
                <div class="swiper-slide text-center" <?= $image ? 'data-slide-bg="' . esc_attr($image) . '"' : ''; ?>>
                    <div class="swiper-slide-caption">
                        <div class="container">
                            <div class="row justify-content-lg-center">
                                <div class="col-lg-10">
                                    <?php if ($title): ?>
                                    <<?= $index === 0 ? 'h1' : 'h2'; ?>
                                    class="welcome__heading heading-decorated"
                                    data-caption-animate="fadeInUpSmall"
                                    data-caption-delay="100">
                                    <?= esc_html($title); ?>
                                </<?= $index === 0 ? 'h1' : 'h2'; ?>>
                                <?php endif; ?>
                                <?php if ($text): ?>
                                    <h4 data-caption-animate="fadeInUpSmall" data-caption-delay="300">
                                        <?= esc_html($text); ?>
                                    </h4>
                                <?php endif; ?>
                                <?php if ($welcome_link): ?>
                                    <a class="button button-primary"
                                       data-caption-animate="fadeInUpSmall"
                                       data-caption-delay="350"
                                       href="<?= esc_url($welcome_link['url']); ?>">
                                        <?= esc_html($welcome_link['title']); ?>
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
