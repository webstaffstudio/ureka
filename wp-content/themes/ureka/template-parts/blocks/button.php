<?php
/**
 * Block Name: Button
 * Description: A customizable button block for adding links with styles and alignment options.
 * Icon: button
 * Keywords: button, link, call-to-action, CTA
 * Supports: { "align": ["wide", "full"], "anchor": true }
 */
?>
<?php
$button_block = get_field('button_block');
$position = get_field('position_button_block');
$button_bg_color = get_field('button_block_bg_color');
$button_font_color = get_field('button_block_font_color');
$section_bg_color = get_field('button_block_section_color');

if ($button_block):
    ?>
    <section class="button-block" style="<?= $section_bg_color ? 'background-color:' . esc_attr($section_bg_color) . ';' : '' ?>">
        <div class="container" style="<?= $position ? 'text-align:' . esc_attr($position) . ';' : '' ?>">
            <a href="<?= esc_url($button_block['url']); ?>"
               class="button"
               style="<?= $button_bg_color ? 'background-color:' . esc_attr($button_bg_color) . ';' : '' ?><?= $button_font_color ? 'color:' . esc_attr($button_font_color) . ';' : '' ?>"
               target="<?= esc_attr($button_block['target']); ?>">
                <?= esc_html($button_block['title']); ?>
            </a>
        </div>
    </section>
<?php endif; ?>

