<?php
get_header();
get_template_part('template-parts/page-welcome');
?>

<section class="search-results__form section-lg bg-default">
    <div class="container">
        <div class="row">
            <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
                <input type="text" name="s" value="<?php echo get_search_query(); ?>"
                       placeholder="<?= __('Введіть запит для пошуку', THEME_TD); ?>" class="search-input">
                <button type="submit" class="button button-primary"><?= __('Пошук', THEME_TD); ?></button>
            </form>
        </div>
        <div class="row row-products-list">
            <?php if (have_posts()) : ?>


                <?php
                function get_search_snippet($content, $query)
                {
                    $query = preg_quote($query, '/'); // Екрануємо спецсимволи у запиті
                    $pattern = "/(?:\S+\s+){0,5}\b($query)\b(?:\s+\S+){0,5}/i";
                    if (preg_match($pattern, $content, $matches)) {
                        return '...' . $matches[0] . '...';
                    }
                    return wp_trim_words($content, 20, '...');
                }

                add_filter('the_excerpt', function ($excerpt) {
                    if (is_search()) {
                        global $post;
                        $search_query = get_search_query();
                        $content = strip_shortcodes(strip_tags($post->post_content));
                        return get_search_snippet($content, $search_query);
                    }
                    return $excerpt;
                });
                ?>


                <?php while (have_posts()) : the_post(); ?>
                    <?php
                    $title = get_the_title();
                    $thumb_id = get_post_thumbnail_id();
                    $image = $thumb_id ? wp_get_attachment_image($thumb_id, 'large', false, ['alt' => $title]) : '';
                    $page_welcome = get_field('page_welcome');
                    $description = (!empty($page_welcome['page_description'])) ? $page_welcome['page_description'] : '';
                    $link = get_permalink();
                    ?>
                    <div class="products-list__product col-sm-12 col-md-6">
                        <a href="<?= esc_url($link); ?>" class="product-link">
                            <?php if ($image): ?>
                                <div class="products-list__product-image">
                                    <?= $image; ?>
                                </div>
                            <?php endif; ?>
                            <?= ($title) ? '<h5 class="products-list__product-title">' . $title . '</h5>' : ''; ?>
                            <?php if (function_exists('relevanssi_the_excerpt')): ?>
                                <div class="products-list__product-excerpt">
                                    <p><?= relevanssi_the_excerpt(); ?></p>
                                </div>
                            <?php endif; ?>
                        </a>
                        <a href="<?= esc_url($link); ?>"
                           class="button button-primary"><?= __('Перейти', THEME_TD); ?></a>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="col-12">
                    <p class="no-results"><?= __('За Вашим запитом, результати пошуку відсутні для', THEME_TD) . ' "' . get_search_query() . '". ' . __('Спробуйте інші ключові слова.', THEME_TD); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
