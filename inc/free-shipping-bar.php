<?php
defined('ABSPATH') || exit;

/**
 * Minimum order amount for free shipping in the zone that matches the current cart.
 * Returns 0 when there is no such method.
 */
function loop_wear_free_shipping_threshold() {
    if (!WC()->cart) {
        return 0;
    }

    $packages = WC()->cart->get_shipping_packages();
    if (!$packages) {
        return 0;
    }

    $zone = WC_Shipping_Zones::get_zone_matching_package(reset($packages));

    foreach ($zone->get_shipping_methods(true) as $method) {
        if ('free_shipping' === $method->id && in_array($method->get_option('requires'), ['min_amount', 'either'], true)) {
            return (float) $method->get_option('min_amount');
        }
    }

    return 0;
}

/**
 * Progress bar shown above the cart items.
 * It sits inside the cart form, so WooCommerce AJAX cart updates refresh it too.
 */
function loop_wear_free_shipping_bar() {
    $cart = WC()->cart;

    if (!$cart || $cart->is_empty() || !$cart->needs_shipping()) {
        return;
    }

    $threshold = loop_wear_free_shipping_threshold();
    if ($threshold <= 0) {
        return;
    }

    $total   = max(0, $cart->get_displayed_subtotal() - $cart->get_discount_total());
    $left    = max(0, $threshold - $total);
    $percent = (int) min(100, round($total / $threshold * 100));
    ?>
    <div class="free-shipping-bar bg-tertiary-fixed border-2 border-on-surface shadow-[4px_4px_0px_#121212] p-4 mb-4">
      <p class="flex items-center gap-2 mb-3 text-label-lg font-label-lg uppercase font-bold">
        <span class="material-symbols-outlined">local_shipping</span>
        <?php if ($left > 0) : ?>
          <span>Add <strong class="text-secondary"><?php echo wp_kses_post(wc_price($left)); ?></strong> more for free shipping</span>
        <?php else : ?>
          <span>You unlocked free shipping!</span>
        <?php endif; ?>
      </p>

      <div class="h-4 border-2 border-on-surface bg-surface-container-lowest" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo esc_attr($percent); ?>">
        <div class="h-full bg-primary-container transition-all duration-500" style="width: <?php echo esc_attr($percent); ?>%"></div>
      </div>
    </div>
    <?php
}
add_action('woocommerce_before_cart_table', 'loop_wear_free_shipping_bar');