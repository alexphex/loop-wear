<?php
defined('ABSPATH') || exit;

/**
 * The theme cannot work without WooCommerce.
 */
function loop_wear_has_woocommerce() {
    return class_exists('WooCommerce');
}

/**
 * Admin: tell the administrator what is missing.
 */
function loop_wear_missing_woocommerce_notice() {
    if (loop_wear_has_woocommerce() || !current_user_can('activate_plugins')) {
        return;
    }

    echo '<div class="notice notice-error"><p><strong>Loop Wear</strong> requires WooCommerce. Please install and activate it.</p></div>';
}
add_action('admin_notices', 'loop_wear_missing_woocommerce_notice');

/**
 * Front end: show a plain message instead of a fatal error.
 */
function loop_wear_requirements_template($template) {
    if (loop_wear_has_woocommerce()) {
        return $template;
    }

    return get_theme_file_path('requirements-notice.php');
}
add_filter('template_include', 'loop_wear_requirements_template', 99);