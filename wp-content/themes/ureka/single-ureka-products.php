<?php
get_header();
get_template_part('template-parts/page-welcome');
if (have_posts()):
    while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile;
endif; ?>
<?php get_footer(); ?>
