<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_cart');
?>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

  <form class="woocommerce-cart-form lg:col-span-8" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
    <?php do_action('woocommerce_before_cart_table'); ?>
    <?php do_action('woocommerce_before_cart_contents'); ?>

    <div class="flex flex-col gap-4">
      <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
          $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
          $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

          if (!$_product || !$_product->exists() || $cart_item['quantity'] <= 0 || !apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
              continue;
          }

          $permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
          ?>
        <div class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?> flex gap-4 bg-surface-container-lowest border-2 border-on-surface shadow-[4px_4px_0px_#121212] p-4">

          <!-- Image -->
          <div class="w-24 h-24 sm:w-32 sm:h-32 shrink-0 border-2 border-on-surface overflow-hidden bg-surface-variant">
            <?php
            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_thumbnail', ['class' => 'w-full h-full object-cover']), $cart_item, $cart_item_key);
            echo $permalink ? '<a href="' . esc_url($permalink) . '">' . $thumbnail . '</a>' : $thumbnail;
            ?>
          </div>

          <div class="grow flex flex-col justify-between gap-3">

            <!-- Name, options, remove -->
            <div class="flex justify-between gap-3">
              <div>
                <h2 class="text-headline-sm font-headline-sm uppercase leading-tight">
                  <?php
                  echo wp_kses_post(apply_filters(
                      'woocommerce_cart_item_name',
                      $permalink ? sprintf('<a href="%s">%s</a>', esc_url($permalink), $_product->get_name()) : $_product->get_name(),
                      $cart_item,
                      $cart_item_key
                  ));
                  ?>
                </h2>
                <?php do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key); ?>
                <div class="text-body-sm text-on-surface-variant font-bold uppercase"><?php echo wp_kses_post(wc_get_formatted_cart_item_data($cart_item)); ?></div>
                <p class="text-label-md font-label-md uppercase font-bold text-on-surface-variant mt-1">
                  <?php echo wp_kses_post(apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key)); ?>
                </p>
              </div>

              <div class="product-remove">
                <?php
                echo apply_filters(
                    'woocommerce_cart_item_remove_link',
                    sprintf(
                        '<a href="%s" class="remove w-9 h-9 border-2 border-on-surface bg-surface flex items-center justify-center hover:bg-secondary-container" aria-label="%s" data-product_id="%s" data-product_sku="%s"><span class="material-symbols-outlined text-[20px]">close</span></a>',
                        esc_url(wc_get_cart_remove_url($cart_item_key)),
                        esc_attr(sprintf('Remove %s from cart', wp_strip_all_tags($_product->get_name()))),
                        esc_attr($product_id),
                        esc_attr($_product->get_sku())
                    ),
                    $cart_item_key
                );
                ?>
              </div>
            </div>

            <!-- Quantity and subtotal -->
            <div class="flex items-end justify-between gap-3">
              <?php
              if ($_product->is_sold_individually()) {
                  $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
              } else {
                  $product_quantity = woocommerce_quantity_input([
                      'input_name'   => "cart[{$cart_item_key}][qty]",
                      'input_value'  => $cart_item['quantity'],
                      'max_value'    => $_product->get_max_purchase_quantity(),
                      'min_value'    => '0',
                      'product_name' => $_product->get_name(),
                  ], $_product, false);
              }
              echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
              ?>
              <span class="text-headline-sm font-headline-sm font-extrabold text-primary">
                <?php echo wp_kses_post(apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key)); ?>
              </span>
            </div>

          </div>
        </div>
      <?php endforeach; ?>

      <?php do_action('woocommerce_cart_contents'); ?>

      <!-- Actions -->
      <div class="actions flex flex-wrap items-center justify-between gap-4 mt-2">
        <?php if (wc_coupons_enabled()) : ?>
          <div class="coupon flex gap-3 grow">
            <label for="coupon_code" class="screen-reader-text">Coupon:</label>
            <input type="text" name="coupon_code" id="coupon_code" value="" placeholder="Coupon code" class="input-text grow border-2 border-on-surface bg-surface-container-lowest px-3 py-3 focus:ring-0 focus:border-on-surface">
            <button type="submit" class="button" name="apply_coupon" value="Apply coupon">Apply coupon</button>
          </div>
        <?php endif; ?>

        <button type="submit" class="button" name="update_cart" value="Update cart" disabled aria-disabled="true">Update cart</button>

        <?php do_action('woocommerce_cart_actions'); ?>
        <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
      </div>
    </div>

    <?php do_action('woocommerce_after_cart_contents'); ?>
    <?php do_action('woocommerce_after_cart_table'); ?>
  </form>

  <?php do_action('woocommerce_before_cart_collaterals'); ?>

  <div class="cart-collaterals lg:col-span-4">
    <?php do_action('woocommerce_cart_collaterals'); ?>
  </div>

</div>

<?php do_action('woocommerce_after_cart'); ?>