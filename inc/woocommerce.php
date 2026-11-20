<?php
defined('ABSPATH') || exit;

/**
 * Cart counter markup. Used in the header and refreshed by WooCommerce AJAX fragments.
 */
function loop_wear_cart_count() {
    $count = (function_exists('WC') && WC()->cart) ? WC()->cart->get_cart_contents_count() : 0;

    return '<span class="js-cart-count">' . (int) $count . '</span>';
}

function loop_wear_cart_fragments($fragments) {
    $fragments['span.js-cart-count'] = loop_wear_cart_count();

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'loop_wear_cart_fragments');

/**
 * "Add to cart" link: AJAX for simple products, link to the product page otherwise.
 * $inner is trusted HTML from our own templates.
 */
function loop_wear_add_to_cart_link($product, $classes = '', $inner = '') {
    $ajax  = $product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock();
    $class = trim(($ajax ? 'add_to_cart_button ajax_add_to_cart ' : '') . $classes);

    return sprintf(
        '<a href="%s" data-product_id="%d" data-product_sku="%s" data-quantity="1" aria-label="%s" rel="nofollow" class="%s">%s</a>',
        esc_url($product->add_to_cart_url()),
        $product->get_id(),
        esc_attr($product->get_sku()),
        esc_attr($product->add_to_cart_description()),
        esc_attr($class),
        $inner
    );
}

/**
 * Products per page in the catalog.
 */
function loop_wear_products_per_page() {
    return 9;
}
add_filter('loop_shop_per_page', 'loop_wear_products_per_page');

/**
 * Breadcrumbs markup and style.
 */
function loop_wear_breadcrumb_defaults($defaults) {
    $defaults['delimiter']   = '<span class="mx-2">/</span>';
    $defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb text-label-md font-label-md uppercase font-bold text-on-surface-variant mb-6 [&_a]:text-primary [&_a:hover]:underline" aria-label="Breadcrumb">';
    $defaults['home']        = 'Home';

    return $defaults;
}
add_filter('woocommerce_breadcrumb_defaults', 'loop_wear_breadcrumb_defaults');

// The theme styles WooCommerce itself, so the plugin's default CSS is not loaded.
add_filter('woocommerce_enqueue_styles', '__return_empty_array');