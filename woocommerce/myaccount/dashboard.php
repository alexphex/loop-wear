<?php
defined('ABSPATH') || exit;

$user  = wp_get_current_user();
$cards = [
    'orders'       => ['receipt_long', 'Orders', 'Track your drops and past purchases'],
    'edit-address' => ['home_pin', 'Addresses', 'Billing and shipping details'],
    'edit-account' => ['manage_accounts', 'Account details', 'Name, email and password'],
];
?>

<div class="bg-tertiary-fixed border-3 border-on-surface shadow-[6px_6px_0px_#121212] p-6 mb-8">
  <p class="text-label-sm font-label-sm font-extrabold uppercase mb-1">WELCOME BACK</p>
  <h2 class="text-headline-lg font-headline-lg uppercase tracking-tight">Hello, <?php echo esc_html($user->display_name); ?></h2>
  <p class="mt-2 text-body-md">Not you? <a href="<?php echo esc_url(wc_logout_url()); ?>" class="underline font-bold">Log out</a></p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <?php foreach ($cards as $endpoint => [$icon, $title, $text]) : ?>
    <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" class="bg-surface-container-lowest border-2 border-on-surface p-5 shadow-[4px_4px_0px_#121212] hover:shadow-[8px_8px_0px_#121212] hover:-translate-y-1 transition-all flex flex-col gap-3">
      <span class="w-12 h-12 bg-primary-container text-surface border-2 border-on-surface flex items-center justify-center shadow-[3px_3px_0px_#121212]">
        <span class="material-symbols-outlined"><?php echo esc_html($icon); ?></span>
      </span>
      <h3 class="text-headline-sm font-headline-sm uppercase"><?php echo esc_html($title); ?></h3>
      <p class="text-body-sm text-on-surface-variant"><?php echo esc_html($text); ?></p>
    </a>
  <?php endforeach; ?>
</div>

<?php do_action('woocommerce_account_dashboard'); ?>