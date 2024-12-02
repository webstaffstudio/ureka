<?php
class Ureka_Walker_Nav_Menu extends Walker_Nav_Menu {
public function start_lvl(&$output, $depth = 0, $args = null) {
$indent = str_repeat("\t", $depth);
$classes = $depth >= 0 ? 'rd-navbar-dropdown' : 'sub-menu';
$output .= "\n$indent<ul class=\"$classes\">\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
    $indent = ($depth) ? str_repeat("\t", $depth) : '';
    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = 'menu-item';
    if ($depth > 0) {
    $classes[] = 'sub-menu-item';
    }
    if (in_array('menu-item-has-children', $classes)) {
    $classes[] = 'has-children';
    }
    if (in_array('current-menu-item', $classes) || in_array('current-menu-ancestor', $classes)) {
    $classes[] = 'active';
    }

    $classes = array_filter($classes);
    $class_names = join(' ', apply_filters('nav_menu_css_class', array_unique($classes), $item, $args));
    $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

    $id = apply_filters('nav_menu_item_id', '', $item, $args);
    $id = $id ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li' . $id . $class_names . '>';

    $atts = array();
    $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
    $atts['target'] = !empty($item->target) ? $item->target : '';
    $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
    $atts['href'] = !empty($item->url) ? $item->url : '';

    $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);
    $attributes = '';

    foreach ($atts as $attr => $value) {
    if (!empty($value)) {
    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
    $attributes .= ' ' . $attr . '="' . $value . '"';
    }
    }

    $title = apply_filters('the_title', $item->title, $item->ID);
    $title = apply_filters('nav_menu_item_title', $title, $item, $args);

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . $title . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
    $output .= "</li>\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
}
}
