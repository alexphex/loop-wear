<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_account_navigation');

$icons = [
    'dashboard'       => 'dashboard',
    'orders'          => 'receipt_long',
    'downloads'       => 'download',
    'edit-address'    => 'home_pin',
    'edit-account'    => 'manage_accounts',
    'customer-logout' => 'logout',
];
?>

<nav class="woocommerce-MyAccount-navigation" aria-label="Account pages">
  <ul>
    <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
      <li class="<?php echo esc_attr(wc_get_account_menu_item_classes($endpoint)); ?>">
        <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>">
          <span class="material-symbols-outlined"><?php echo esc_html($icons[$endpoint] ?? 'chevron_right'); ?></span>
          <?php echo esc_html($label); ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>

<?php do_action('woocommerce_after_account_navigation'); ?>