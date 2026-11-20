<?php
defined('ABSPATH') || exit;

/**
 * Tailwind classes for primary menu links.
 */
function loop_wear_nav_link_attributes($atts, $item, $args) {
    if (isset($args->theme_location) && 'primary' === $args->theme_location) {
        $atts['class'] = 'text-on-surface font-bold hover:text-secondary';
    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'loop_wear_nav_link_attributes', 10, 3);

// The primary menu is rendered twice (desktop and mobile): drop li ids to avoid duplicates.
add_filter('nav_menu_item_id', '__return_empty_string');