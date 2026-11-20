<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_checkout_form', $checkout);

if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', 'You must be logged in to checkout.'));
    return;
}
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout grid grid-cols-1 lg:grid-cols-12 gap-8 items-start" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

  <?php if ($checkout->get_checkout_fields()) : ?>
    <div id="customer_details" class="lg:col-span-7 bg-surface-container-lowest border-2 border-on-surface shadow-[4px_4px_0px_#121212] p-6 flex flex-col gap-8">
      <?php do_action('woocommerce_checkout_before_customer_details'); ?>
      <div><?php do_action('woocommerce_checkout_billing'); ?></div>
      <div><?php do_action('woocommerce_checkout_shipping'); ?></div>
      <?php do_action('woocommerce_checkout_after_customer_details'); ?>
    </div>
  <?php endif; ?>

  <div class="lg:col-span-5 bg-surface-container-lowest border-3 border-on-surface shadow-[6px_6px_0px_#121212] p-6 lg:sticky lg:top-32">
    <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
    <h3 id="order_review_heading">Your order</h3>
    <?php do_action('woocommerce_checkout_before_order_review'); ?>

    <div id="order_review" class="woocommerce-checkout-review-order">
      <?php do_action('woocommerce_checkout_order_review'); ?>
    </div>

    <?php do_action('woocommerce_checkout_after_order_review'); ?>
  </div>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>