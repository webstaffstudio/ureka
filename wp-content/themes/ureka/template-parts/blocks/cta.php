<?php
/**
 * Block Name: CTA
 * Description: A flexible block for creating Calls to Action with headings, text, and buttons to drive user engagement.
 * Icon: megaphone
 * Keywords: CTA, call to action, button, link, marketing
 * Supports: { "align": ["wide", "full"], "anchor": true }
 */

$cta_title = get_field('cta_block_title');
$cta_text = get_field('cta_block_text');
$cta_button = get_field('cta_block_button');
$cta_email_subject = get_field('cta_block_email_subject');
$section_bg_color = get_field('cta_block_color');
$border_top_enable = (get_field('cta_block_bt_enable')) ? ' border-top-enable' : '';
$border_bottom_enable = (get_field('cta_block_bb_enable')) ? ' border-bottom-enable' : '';
$style_classes = $border_top_enable . $border_bottom_enable;
$section_bg_color = get_field('cta_block_color');
if ($cta_button && strpos($cta_button['url'], 'mailto:') === 0) {
    $cta_button_url = $cta_button['url'] . '?subject=' . rawurlencode($cta_email_subject);
} else {
    $cta_button_url = $cta_button['url'] ?? '';
}
?>
<section class="cta flex-cta<?=$style_classes;?>" <?= $section_bg_color ? 'style="background-color:' . esc_attr($section_bg_color) . ';"' : '' ?>>
    <div class="container">
        <div class="cta__wrapper">
            <?= ($cta_title) ? '<h3 class="cta__wrapper-title">' . $cta_title . '</h3>' : ''; ?>
            <?= ($cta_text) ? '<p class="cta__wrapper-text">' . $cta_text . '</p>' : ''; ?>
            <?= ($cta_button) ? '<a href="' . $cta_button_url . '" class="button button-primary">' . $cta_button['title'] . '</a>' : ''; ?>
        </div>
    </div>
</section>
