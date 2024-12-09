<?php
/**
 * Block Name: Products
 * Description: A block to showcase Ureka products.
 * Icon: cart
 * Keywords: products, shop, items, store
 * Supports: { "align": ["wide", "full"], "anchor": true }
 */

$title = get_field('products_list_title');
$products_to_show = get_field('products_to_show');
$grid = get_field('products_list_grid');
$grid_class = $grid === 'col_2' ? 'col-md-6' : 'col-md-4';
$button_label = get_field('products_list_btn_label') ;
$args = array(
    'post_type' => 'ureka-products',
    'posts_per_page' => $products_to_show ? $products_to_show : -1,
);

$query = new WP_Query($args);

if ($query->have_posts()): ?>
    <section class="products-list">
        <div class="container">
                <div class="col-sm-12 text-center">
                    <?= ($title) ? '<h2 class="products-list__wrapper-title heading-decorated">' . $title . '</h2>' : ''; ?>
                </div>
                <div class="row row-products-list">
                    <?php foreach ($query->posts as $post):
                        $title = get_the_title($post->ID);
                        $thumb_id = get_post_thumbnail_id($post->ID);
                        $image = get_image_html($thumb_id, 'large', '', $title);
                        $page_welcome = get_field('page_welcome', $post->ID);
                        $description = (!empty($page_welcome['page_description'])) ? $page_welcome['page_description'] : '';
                        $link = get_permalink($post->ID); ?>
                        <div class="products-list__product <?= $grid_class; ?> col-sm-12">
                            <a href="<?= esc_url($link); ?>" class="product-link"">
                                <?php if ($image): ?>
                                    <div class="products-list__product-image">
                                        <?= $image; ?>
                                    </div>
                                <?php endif; ?>
                                <?= ($title) ? '<h5 class="products-list__product-title">' . $title . '</h5>' : ''; ?>
                                <?= ($description) ? '<p class="products-list__product-descr">' . ($description) . '</p>' : ''; ?>
                            </a>
                            <a href="<?= esc_url($link); ?>" class="button button-primary"><?= $button_label;?></a>
                        </div>
                    <?php endforeach; ?>
                </div>
        </div>
    </section>
<?php endif;
wp_reset_postdata();
?>

<script>
    function matchHeight(selector) {
        function adjustHeight() {
            const elements = document.querySelectorAll(selector);
            let maxHeight = 0;
            elements.forEach(el => {
                el.style.height = 'auto'; // Reset height
                const elHeight = el.offsetHeight;
                if (elHeight > maxHeight) {
                    maxHeight = elHeight;
                }
            });

            elements.forEach(el => {
                el.style.height = maxHeight + 'px';
            });
        }

        // Run on initialization
        adjustHeight();

        // Attach resize event inside the function
        window.addEventListener('resize', adjustHeight);
    }

    // Usage
    document.addEventListener('DOMContentLoaded', function() {
    matchHeight('.products-list__product');
    });
</script>
