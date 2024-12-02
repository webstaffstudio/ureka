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
            <div class="swiper products-carousel" >
                <div class="swiper-wrapper">
                    <?php foreach ($products as $product):
                        $image = get_the_post_thumbnail_url($product, 'large');
                        $title = get_the_title($product);
                        $permalink = get_permalink($product);
                        ?>
                        <div class="swiper-slide">
                            <div class="post-classic post-minimal">
                                <a href="<?= esc_url($permalink); ?>">
                                    <img  class="products-carousel__image"  src="<?= esc_url($image); ?>" alt="<?= esc_attr($title); ?>"/>
                                    <h6><?= esc_html($title); ?></h6>
                                </a>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
            <div class="products-carousel-nav-left products-slider-nav linear-icon-chevron-left"></div>
            <div class="products-carousel-nav-right products-slider-nav linear-icon-chevron-right"></div>
        </div>
    </section>
<?php endif; ?>
