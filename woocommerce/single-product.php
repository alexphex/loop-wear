<?php
defined('ABSPATH') || exit;

get_header();
?>

<main class="max-w-[1440px] mx-auto px-6 lg:px-8 py-10">

<?php while (have_posts()) : the_post();
    global $product;
    $product = wc_get_product(get_the_ID());

    $image_ids = array_values(array_filter(array_merge([$product->get_image_id()], $product->get_gallery_image_ids())));
    $cats      = wc_get_product_terms($product->get_id(), 'product_cat');
    $cat       = $cats ? $cats[0]->name : '';
    $rating    = (int) round((float) $product->get_average_rating());
    $reviews   = (int) $product->get_review_count();
    $short     = $product->get_short_description();
    $desc      = $product->get_description();

    $related_ids = wc_get_related_products($product->get_id(), 4);
    $related     = $related_ids ? wc_get_products(['include' => $related_ids, 'limit' => 4]) : [];

    $tabs = [
        'description' => 'Description',
        'additional'  => 'Additional information',
        'reviews'     => 'Reviews (' . $reviews . ')',
    ];
    ?>

  <?php woocommerce_breadcrumb(); ?>
  <?php woocommerce_output_all_notices(); ?>

  <div id="product-<?php the_ID(); ?>" <?php wc_product_class('grid grid-cols-1 lg:grid-cols-12 gap-10', $product); ?>>

    <!-- Gallery -->
    <div class="lg:col-span-7">
      <div class="relative h-[420px] md:h-[560px] bg-surface-container-lowest border-3 border-on-surface shadow-[8px_8px_0px_#121212] overflow-hidden [&_img]:w-full [&_img]:h-full [&_img]:object-cover">
        <?php if ($product->is_on_sale()) : ?>
          <span class="absolute top-4 left-4 z-10 bg-secondary-container text-surface border-2 border-on-surface px-3 py-1 text-label-md font-label-md uppercase font-extrabold -rotate-2 shadow-[2px_2px_0px_#121212]">SALE</span>
        <?php endif; ?>

        <?php if ($image_ids) : foreach ($image_ids as $i => $id) : ?>
          <div data-slide="<?php echo (int) $i; ?>" class="<?php echo $i ? 'hidden' : ''; ?> w-full h-full">
            <?php echo wp_get_attachment_image($id, 'woocommerce_single'); ?>
          </div>
        <?php endforeach; else :
            echo wc_placeholder_img('woocommerce_single');
        endif; ?>
      </div>

      <?php if (count($image_ids) > 1) : ?>
        <div class="grid grid-cols-4 gap-4 mt-6">
          <?php foreach ($image_ids as $i => $id) : ?>
            <button type="button" data-thumb="<?php echo (int) $i; ?>" aria-current="<?php echo $i ? 'false' : 'true'; ?>" class="h-24 border-2 border-on-surface bg-surface-container-lowest overflow-hidden transition-transform [&_img]:w-full [&_img]:h-full [&_img]:object-cover">
              <?php echo wp_get_attachment_image($id, 'woocommerce_thumbnail'); ?>
            </button>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

    <!-- Summary -->
    <div class="lg:col-span-5 flex flex-col gap-6">

      <div>
        <?php if ($cat) : ?>
          <p class="text-label-md font-label-md text-on-surface-variant font-bold uppercase mb-2"><?php echo esc_html($cat); ?></p>
        <?php endif; ?>
        <h1 class="text-4xl md:text-headline-lg font-headline-lg text-on-surface uppercase tracking-tight"><?php the_title(); ?></h1>
      </div>

      <div class="flex flex-wrap items-center gap-4">
        <span class="price text-headline-md font-headline-md text-primary font-extrabold bg-surface-variant border-2 border-on-surface px-3 py-1 shadow-[3px_3px_0px_#121212]">
          <?php echo wp_kses_post($product->get_price_html()); ?>
        </span>

        <?php if ($reviews) : ?>
          <a href="#reviews" data-open-tab="reviews" class="text-label-lg font-label-lg font-bold">
            <span class="text-secondary"><?php echo esc_html(str_repeat('★', $rating) . str_repeat('☆', 5 - $rating)); ?></span>
            (<?php echo esc_html($reviews); ?>)
          </a>
        <?php else : ?>
          <span class="text-label-md font-label-md uppercase font-bold text-on-surface-variant">No reviews yet</span>
        <?php endif; ?>
      </div>

      <?php if ($short) : ?>
        <div class="text-body-lg font-body-lg text-on-surface-variant border-l-4 border-primary-container pl-4 py-1">
          <?php echo wp_kses_post(apply_filters('woocommerce_short_description', $short)); ?>
        </div>
      <?php endif; ?>

      <?php woocommerce_template_single_add_to_cart(); ?>

      <div class="border-t-2 border-on-surface pt-4 flex flex-col gap-1 text-label-md font-label-md uppercase font-bold">
        <?php if ($product->get_sku()) : ?>
          <span>SKU: <?php echo esc_html($product->get_sku()); ?></span>
        <?php endif; ?>
        <span>Category: <span class="text-primary [&_a:hover]:underline"><?php echo wp_kses_post(wc_get_product_category_list($product->get_id(), ', ')); ?></span></span>
      </div>

      <div class="flex flex-col gap-2 text-label-md font-label-md uppercase font-bold">
        <span class="flex items-center gap-2"><span class="material-symbols-outlined text-primary">local_shipping</span> Express worldwide drop</span>
        <span class="flex items-center gap-2"><span class="material-symbols-outlined text-secondary">autorenew</span> 30-day street test returns</span>
      </div>
    </div>
  </div>

  <!-- Tabs -->
  <section class="mt-16">
    <div role="tablist" class="flex flex-wrap gap-3 mb-6">
      <?php foreach ($tabs as $key => $label) : ?>
        <button type="button" role="tab" data-tab="<?php echo esc_attr($key); ?>" aria-selected="<?php echo $key === 'description' ? 'true' : 'false'; ?>" class="border-2 border-on-surface bg-surface-container-lowest px-5 py-2 text-label-lg font-label-lg uppercase font-bold shadow-[3px_3px_0px_#121212]">
          <?php echo esc_html($label); ?>
        </button>
      <?php endforeach; ?>
    </div>

    <div class="bg-surface-container-lowest border-2 border-on-surface shadow-[4px_4px_0px_#121212] p-6 md:p-8">

      <div data-panel="description" class="product-content">
        <?php echo $desc ? wp_kses_post(apply_filters('the_content', $desc)) : '<p>No description yet.</p>'; ?>
      </div>

      <div data-panel="additional" class="hidden">
        <?php if ($product->has_attributes() || $product->has_weight() || $product->has_dimensions()) {
            wc_display_product_attributes($product);
        } else {
            echo '<p class="text-body-md">No additional information.</p>';
        } ?>
      </div>

      <div data-panel="reviews" class="hidden">
        <?php comments_template(); ?>
      </div>

    </div>
  </section>

  <!-- Related -->
  <?php if ($related) : ?>
    <section class="mt-20">
      <div class="mb-8 border-b-2 border-on-surface pb-4">
        <h2 class="text-headline-lg font-headline-lg text-on-surface uppercase tracking-tight">YOU MIGHT ALSO LOOP</h2>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($related as $p) {
            get_template_part('template-parts/product-card', null, ['product' => $p]);
        } ?>
      </div>
    </section>
  <?php endif; ?>

<?php endwhile; ?>

</main>

<script>
(function () {
  var slides = document.querySelectorAll('[data-slide]');
  var thumbs = document.querySelectorAll('[data-thumb]');
  thumbs.forEach(function (btn) {
    btn.addEventListener('click', function () {
      slides.forEach(function (s) { s.classList.toggle('hidden', s.dataset.slide !== btn.dataset.thumb); });
      thumbs.forEach(function (t) { t.setAttribute('aria-current', t === btn ? 'true' : 'false'); });
    });
  });

  var tabs = document.querySelectorAll('[data-tab]');
  var panels = document.querySelectorAll('[data-panel]');
  function openTab(name) {
    tabs.forEach(function (t) { t.setAttribute('aria-selected', t.dataset.tab === name ? 'true' : 'false'); });
    panels.forEach(function (p) { p.classList.toggle('hidden', p.dataset.panel !== name); });
  }
  tabs.forEach(function (t) { t.addEventListener('click', function () { openTab(t.dataset.tab); }); });
  document.querySelectorAll('[data-open-tab]').forEach(function (a) {
    a.addEventListener('click', function () { openTab(a.dataset.openTab); });
  });
  if (location.hash === '#reviews' || location.hash.indexOf('#comment-') === 0) { openTab('reviews'); }
})();
</script>

<?php get_footer(); ?>