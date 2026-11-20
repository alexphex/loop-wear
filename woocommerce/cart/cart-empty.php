<?php defined('ABSPATH') || exit; ?>

<div class="bg-surface-container-lowest border-2 border-on-surface shadow-[4px_4px_0px_#121212] p-10 text-center">
  <h2 class="text-headline-md font-headline-md uppercase mb-2">Your cart is empty</h2>
  <p class="text-body-md text-on-surface-variant mb-6">Nothing here yet. Go grab some heat.</p>
  <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="inline-block bg-primary-container text-surface border-2 border-on-surface px-6 py-3 text-label-lg font-label-lg font-extrabold uppercase shadow-[3px_3px_0px_#121212]">Back to shop</a>
</div>