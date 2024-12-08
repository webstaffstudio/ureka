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
$grid_class = $grid === 'col_2' ? 'col-6' : 'col-4';
$button_label = get_field('products_list_btn_label') ;
$args = array(
    'post_type' => 'ureka-products',
    'posts_per_page' => $products_to_show ? $products_to_show : -1,
);

$query = new WP_Query($args);

if ($query->have_posts()): ?>
    <section class="products-list">
        <div class="container">
            <div class="products-list__wrapper row">
                <div class="col-sm-12 text-center">
                    <?= ($title) ? '<h2 class="products-list__wrapper-title heading-decorated">' . $title . '</h2>' : ''; ?>
                </div>
                <div class="row">
                    <?php foreach ($query->posts as $post):
                        $title = get_the_title($post->ID);
                        $thumb_id = get_post_thumbnail_id($post->ID);
                        $image = get_image_html($thumb_id, 'large', '', $title);
                        $page_welcome = get_field('page_welcome', $post->ID);
                        $description = (!empty($page_welcome['page_description'])) ? $page_welcome['page_description'] : '';
                        $link = get_permalink($post->ID); ?>
                        <div class="products-list__product <?= $grid_class; ?>">
                            <a href="<?= esc_url($link); ?>" class="product-link"">
                                <?php if ($image): ?>
                                    <div class="products-list__product-image">
                                        <?= $image; ?>
                                        <span class="product-link-label"><?=($button_label) ?? 'Read More';?></span>
                                    </div>
                                <?php endif; ?>
                                <?= ($title) ? '<h5 class="products-list__product-title">' . $title . '</h5>' : ''; ?>
                                <?= ($description) ? '<p class="products-list__product-descr">' . ($description) . '</p>' : ''; ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif;
wp_reset_postdata();
?>

