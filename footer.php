<?php
$columns = [
    'Drop Vault' => [
        'Shop'           => wc_get_page_permalink('shop'),
        'Hoodies & Tees' => home_url('/product-category/hoodies-tees/'),
        'Outerwear'      => home_url('/product-category/outerwear/'),
    ],
    'Archive' => [
        'Bottoms' => home_url('/product-category/bottoms/'),
        'Collabs' => '#',
        'Archive' => '#',
    ],
    'Customer Care' => [
        'Shipping & Customs' => '#',
        'Returns'            => '#',
        'Size Matrix Guide'  => '#',
    ],
    'Legal & Code' => [
        'Privacy Policy'       => '#',
        'Terms of Service'     => '#',
        'Zero Deadstock Charter' => '#',
    ],
];
$socials  = ['IG', 'TK', 'YT', 'DC'];
$payments = ['VISA', 'MASTERCARD', 'AMEX', 'APPLE PAY', 'PAYPAL'];
?>

<footer class="bg-on-surface text-surface border-t-4 border-on-surface">
  <div class="w-full px-8 py-16 max-w-[1440px] mx-auto flex flex-col gap-12">

    <!-- Wordmark + socials -->
    <div class="border-b-2 border-surface/20 pb-8 flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6">
      <div>
        <span class="text-label-md font-label-md uppercase tracking-widest text-surface-dim font-bold">UNDERGROUND STREETWEAR ECOSYSTEM</span>
        <h2 class="text-[44px] leading-[48px] sm:text-display-xl font-display-xl uppercase tracking-tighter text-surface leading-none">LOOP WEAR</h2>
      </div>
      <div class="flex items-center gap-3">
        <?php foreach ($socials as $s) : ?>
          <a href="#" class="w-12 h-12 bg-surface text-on-surface hover:bg-tertiary-fixed border-2 border-surface flex items-center justify-center font-bold text-headline-sm"><?php echo esc_html($s); ?></a>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Links + payments -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
      <?php foreach ($columns as $title => $links) : ?>
        <div class="flex flex-col gap-3">
          <span class="text-label-lg font-label-lg uppercase tracking-wider text-tertiary-fixed font-bold"><?php echo esc_html($title); ?></span>
          <?php foreach ($links as $label => $url) : ?>
            <a href="<?php echo esc_url($url); ?>" class="text-surface-dim font-medium hover:text-tertiary-fixed hover:underline text-body-sm font-body-sm"><?php echo esc_html($label); ?></a>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>

      <div class="col-span-2 flex flex-col gap-4">
        <span class="text-label-lg font-label-lg uppercase tracking-wider text-tertiary-fixed font-bold">We accept</span>
        <div class="flex flex-wrap gap-2">
          <?php foreach ($payments as $p) : ?>
            <span class="border border-surface/30 px-2.5 py-1 text-label-sm font-label-sm font-bold bg-surface/10"><?php echo esc_html($p); ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- Bottom row -->
    <div class="border-t-2 border-surface/20 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-body-sm font-body-sm text-surface-dim">
      <p>© <?php echo esc_html(date('Y')); ?> LOOP WEAR. ZERO BORING CLOTHES.<?php if (loop_wear_is_demo()) : ?> DEMO PROJECT, NOT A REAL STORE.<?php endif; ?></p>
      <span class="flex items-center gap-1 font-bold text-surface">
        <span class="w-2 h-2 rounded-full bg-green-400"></span>
        ALL DISTRIBUTION HUBS OPERATIONAL
      </span>
    </div>

  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>