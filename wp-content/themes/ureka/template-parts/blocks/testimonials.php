<?php
/**
 * Block Name: Testimonials
 * Description: Display customer testimonials to build trust and showcase feedback.
 * Icon: format-quote
 * Keywords: testimonials, feedback, reviews, quotes
 * Supports: { "align": ["wide", "full"], "anchor": true }
 */
?>
<?php
$title = get_field('title');
$testimonials = get_field('testimonials');
if ($testimonials): ?>
    <section class="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <?= $title ? '<h4 class="heading-decorated text-center testimonials__title">' . esc_html($title) . '</h4>' : ''; ?>
                </div>
            </div>
            <div class=" swiper testimonials__slider">
                <div class="swiper-wrapper">
                    <?php foreach ($testimonials as $testimonial):
                        $photo = $testimonial['photo'];
                        $name = $testimonial['name'];
                        $position = $testimonial['position'];
                        $company_name = $testimonial['company_name'];
                        $text = $testimonial['text'];
                        ?>
                        <div class="swiper-slide">
                            <div class="quote-default quote-default_left">
                                <div class="quote-default__image">
                                    <img src="<?= $photo; ?>" alt="<?= $name; ?>">
                                </div>
                                <div class="quote-default__text">
                                    <?= $text ? '<p class="q">' . esc_html($text) . '</p>' : ''; ?>
                                </div>
                                <?= $name ? '<p class="quote-default__cite-name">' . esc_html($name) . '</p>' : ''; ?>
                                <?= $position ? '<p class="quote-default__cite-position">' . esc_html($position) . '</p>' : ''; ?>
                                <?= $company_name ? '<p class="quote-default__cite-company">' . esc_html($company_name) . '</p>' : ''; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

