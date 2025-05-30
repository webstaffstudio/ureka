<?php
/**
 * Block Name: Products Slider
 * Description: A slider block to display a range of products dynamically with Swiper.js.
 * Icon: slides
 * Keywords: products, slider, carousel
 * Supports: { "align": ["wide", "full"], "anchor": true }
 */
?>
<?php
$title = get_field('products_slider_title');
$products = get_field('products_slider');
if ($products): ?>
    <section class="products-slider section-md bg-default">
        <div class="container">
            <?php if ($title): ?>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h4 class="heading-decorated"><?= esc_html($title); ?></h4>
                    </div>
                </div>
            <?php endif; ?>
            <div class="swiper products-carousel">
                <div class="swiper-wrapper">
                    <?php foreach ($products as $product_id):
                        $image = get_post_thumbnail_id($product_id);
                        $title = get_the_title($product_id);
                        $permalink = get_permalink($product_id);
                        ?>
                        <div class="swiper-slide">
                            <div class="post-classic post-minimal">
                                <a href="<?= esc_url($permalink); ?>">
                                    <?= get_image_html($image, 'large', 'products-carousel__image', $title); ?>
                                    <h6><?= esc_html($title); ?></h6>
                                </a>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
            <div class="slider-ureka-nav-left slider-ureka-nav linear-icon-chevron-left"></div>
            <div class="slider-ureka-nav-right slider-ureka-nav linear-icon-chevron-right"></div>
        </div>
    </section>
<?php endif; ?>
