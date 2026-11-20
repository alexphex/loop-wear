<?php defined('ABSPATH') || exit; ?>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
  <div class="lg:col-span-3">
    <?php do_action('woocommerce_account_navigation'); ?>
  </div>

  <div class="woocommerce-MyAccount-content lg:col-span-9">
    <?php do_action('woocommerce_account_content'); ?>
  </div>
</div>