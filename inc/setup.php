<?php
defined('ABSPATH') || exit;

/**
 * Theme features and menu locations.
 */
function loop_wear_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');

    register_nav_menus([
        'primary' => 'Primary Menu',
    ]);
}
add_action('after_setup_theme', 'loop_wear_setup');