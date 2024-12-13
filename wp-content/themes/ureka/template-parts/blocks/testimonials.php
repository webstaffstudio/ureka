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
            <div class="swiper testimonials__slider">
                <div class="swiper-wrapper">
                    <?php foreach ($testimonials as $testimonial):
                        $photo = $testimonial['photo'];
                        $name = $testimonial['name'];
                        $position = $testimonial['position'];
                        $company_name = $testimonial['company_name'];
                        $text = $testimonial['text'];
                        ?>
                        <div class="swiper-slide">
                            <div class="testimonials__item">
                                <div class="testimonials__item-photo">
                                    <img src="<?= esc_url($photo); ?>" alt="<?= esc_attr($name); ?>">
                                </div>
                                <div class="cite-meta">
                                    <?= $name ? '<p class="cite-meta__name">' . esc_html($name) . '</p>' : ''; ?>
                                    <?= $position ? '<p class="cite-meta__position">' . esc_html($position) . '</p>' : ''; ?>
                                    <?= $company_name ? '<p class="cite-meta__company">' . esc_html($company_name) . '</p>' : ''; ?>
                                </div>
                                <div class="testimonials__item-text">
                                    <?= $text ? '<div>' . $text . '</div>' : ''; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="slider-ureka-nav-left slider-ureka-nav linear-icon-chevron-left"></div>
            <div class="slider-ureka-nav-right slider-ureka-nav linear-icon-chevron-right"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
<?php endif; ?>



