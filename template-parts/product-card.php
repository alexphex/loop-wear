<?php
$product = $args['product'] ?? wc_get_product(get_the_ID());
if (!$product || !$product->is_visible()) {
    return;
}

$badge = $product->is_on_sale() ? 'SALE' : ($product->is_featured() ? 'TOP PICK' : '');
$cats  = wc_get_product_terms($product->get_id(), 'product_cat');
$cat   = $cats ? $cats[0]->name : '';
?>
<article class="bg-surface border-2 border-on-surface shadow-[4px_4px_0px_#121212] hover:shadow-[8px_8px_0px_#121212] transition-shadow flex flex-col relative group">

  <?php if ($badge) : ?>
    <div class="absolute top-3 left-3 z-10 bg-secondary-container text-surface border-2 border-on-surface px-2.5 py-0.5 text-label-sm font-label-sm uppercase font-extrabold -rotate-2 shadow-[2px_2px_0px_#121212]">
      <?php echo esc_html($badge); ?>
    </div>
  <?php endif; ?>

  <a href="<?php echo esc_url($product->get_permalink()); ?>" class="block bg-surface-container-lowest border-b-2 border-on-surface h-72 overflow-hidden">
    <?php echo $product->get_image('woocommerce_single', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300']); ?>
  </a>

  <div class="p-4 flex flex-col gap-3 grow justify-between">
    <div class="flex justify-between items-start gap-3">
      <div>
        <p class="text-label-sm font-label-sm text-on-surface-variant font-bold uppercase"><?php echo esc_html($cat); ?></p>
        <h3 class="text-headline-sm font-headline-sm text-on-surface uppercase leading-tight">
          <a href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($product->get_name()); ?></a>
        </h3>
      </div>
      <span class="price text-headline-sm font-headline-sm text-primary font-extrabold bg-surface-variant border border-on-surface px-2 py-0.5 whitespace-nowrap">
        <?php echo wp_kses_post($product->get_price_html()); ?>
      </span>
    </div>

    <?php
    echo loop_wear_add_to_cart_link(
        $product,
        'w-full bg-on-surface text-surface hover:bg-primary-container hover:text-on-primary-container border-2 border-on-surface py-2.5 text-label-lg font-label-lg font-extrabold uppercase shadow-[3px_3px_0px_#121212] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none flex items-center justify-center gap-2',
        '<span class="material-symbols-outlined text-[20px]">add</span>' . esc_html($product->add_to_cart_text())
    );
    ?>
  </div>
</article>