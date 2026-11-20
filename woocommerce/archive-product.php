<?php
defined('ABSPATH') || exit;

get_header();

global $wp_query;

$base_url = is_product_category() ? get_term_link(get_queried_object()) : wc_get_page_permalink('shop');
$orderby  = isset($_GET['orderby']) ? wc_clean(wp_unslash($_GET['orderby'])) : 'menu_order';
$min      = isset($_GET['min_price']) ? wc_clean(wp_unslash($_GET['min_price'])) : '';
$max      = isset($_GET['max_price']) ? wc_clean(wp_unslash($_GET['max_price'])) : '';

$sorting = [
    'menu_order' => 'Default sorting',
    'popularity' => 'Best selling',
    'date'       => 'Newest first',
    'price'      => 'Price: low to high',
    'price-desc' => 'Price: high to low',
];

$top_cats = get_terms([
    'taxonomy'   => 'product_cat',
    'parent'     => 0,
    'hide_empty' => false,
    'exclude'    => [(int) get_option('default_product_cat')],
]);
?>

<main class="max-w-[1440px] mx-auto px-6 lg:px-8 py-10">

  <?php woocommerce_breadcrumb(); ?>
  <?php woocommerce_output_all_notices(); ?>

  <!-- Title band -->
  <div class="bg-tertiary-fixed border-3 border-on-surface shadow-[6px_6px_0px_#121212] p-6 md:p-8 mb-10">
    <div class="bg-on-surface text-surface px-2.5 py-0.5 text-label-sm font-label-sm font-extrabold uppercase inline-block mb-2">THE ARCHIVE</div>
    <h1 class="text-4xl md:text-headline-lg font-headline-lg text-on-tertiary-fixed uppercase tracking-tight">
      <?php woocommerce_page_title(); ?>
    </h1>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

    <!-- Sidebar -->
    <aside class="lg:col-span-3 flex flex-col gap-6">

      <!-- Categories -->
      <div class="bg-surface-container-lowest border-2 border-on-surface shadow-[4px_4px_0px_#121212]">
        <h2 class="border-b-2 border-on-surface px-4 py-3 text-headline-sm font-headline-sm uppercase">Category</h2>
        <ul class="p-4 flex flex-col gap-1 text-label-lg font-label-lg uppercase">
          <li>
            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="block px-2 py-1 border-2 <?php echo is_shop() ? 'bg-primary-container text-surface border-on-surface' : 'border-transparent hover:bg-tertiary-fixed'; ?>">All</a>
          </li>
          <?php foreach ($top_cats as $cat) :
              $children = get_terms(['taxonomy' => 'product_cat', 'parent' => $cat->term_id, 'hide_empty' => false]);
              ?>
            <li>
              <a href="<?php echo esc_url(get_term_link($cat)); ?>" class="block px-2 py-1 border-2 <?php echo is_product_category($cat->slug) ? 'bg-primary-container text-surface border-on-surface' : 'border-transparent hover:bg-tertiary-fixed'; ?>">
                <?php echo esc_html($cat->name); ?>
              </a>
              <?php if ($children && !is_wp_error($children)) : ?>
                <ul class="pl-4 mt-1 flex flex-col gap-1">
                  <?php foreach ($children as $child) : ?>
                    <li>
                      <a href="<?php echo esc_url(get_term_link($child)); ?>" class="block px-2 py-1 border-2 <?php echo is_product_category($child->slug) ? 'bg-primary-container text-surface border-on-surface' : 'border-transparent hover:bg-tertiary-fixed'; ?>">
                        <?php echo esc_html($child->name); ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Price -->
      <div class="bg-surface-container-lowest border-2 border-on-surface shadow-[4px_4px_0px_#121212]">
        <h2 class="border-b-2 border-on-surface px-4 py-3 text-headline-sm font-headline-sm uppercase">Price</h2>
        <form method="get" action="<?php echo esc_url($base_url); ?>" class="p-4 flex flex-col gap-3"
              onsubmit="this.querySelectorAll('input').forEach(function (i) { if (!i.value) i.disabled = true; });">
          <?php if (isset($_GET['orderby'])) : ?>
            <input type="hidden" name="orderby" value="<?php echo esc_attr($orderby); ?>">
          <?php endif; ?>
          <div class="flex items-center gap-2">
            <input type="number" name="min_price" min="0" step="any" value="<?php echo esc_attr($min); ?>" placeholder="Min" class="w-full bg-surface-container-lowest border-2 border-on-surface px-3 py-2 text-body-sm focus:ring-0 focus:border-on-surface">
            <span class="font-bold">–</span>
            <input type="number" name="max_price" min="0" step="any" value="<?php echo esc_attr($max); ?>" placeholder="Max" class="w-full bg-surface-container-lowest border-2 border-on-surface px-3 py-2 text-body-sm focus:ring-0 focus:border-on-surface">
          </div>
          <button type="submit" class="bg-on-surface text-surface hover:bg-primary-container border-2 border-on-surface py-2 text-label-lg font-label-lg font-extrabold uppercase shadow-[3px_3px_0px_#121212] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
            Apply
          </button>
          <?php if ($min !== '' || $max !== '') : ?>
            <a href="<?php echo esc_url($base_url); ?>" class="text-label-md font-label-md uppercase font-bold underline">Reset price</a>
          <?php endif; ?>
        </form>
      </div>

    </aside>

    <!-- Products -->
    <div class="lg:col-span-9">

      <!-- Toolbar -->
      <div class="flex flex-wrap items-center justify-between gap-4 mb-6 border-b-2 border-on-surface pb-4">
        <p class="text-label-lg font-label-lg uppercase font-bold">
          <?php echo esc_html($wp_query->found_posts); ?> pieces
        </p>

        <form method="get" action="<?php echo esc_url($base_url); ?>" class="flex items-center gap-2">
          <?php if ($min !== '') : ?><input type="hidden" name="min_price" value="<?php echo esc_attr($min); ?>"><?php endif; ?>
          <?php if ($max !== '') : ?><input type="hidden" name="max_price" value="<?php echo esc_attr($max); ?>"><?php endif; ?>
          <label for="orderby" class="text-label-md font-label-md uppercase font-bold">Sort by</label>
          <select id="orderby" name="orderby" onchange="this.form.submit()" class="bg-surface-container-lowest border-2 border-on-surface pl-3 pr-8 py-2 text-label-md font-label-md font-bold shadow-[2px_2px_0px_#121212] focus:ring-0 focus:border-on-surface">
            <?php foreach ($sorting as $value => $label) : ?>
              <option value="<?php echo esc_attr($value); ?>" <?php selected($orderby, $value); ?>><?php echo esc_html($label); ?></option>
            <?php endforeach; ?>
          </select>
        </form>
      </div>

      <?php if (have_posts()) : ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
          <?php while (have_posts()) : the_post();
              get_template_part('template-parts/product-card', null, ['product' => wc_get_product(get_the_ID())]);
          endwhile; ?>
        </div>

        <?php
        $links = paginate_links([
            'type'      => 'array',
            'mid_size'  => 1,
            'prev_text' => '<span class="material-symbols-outlined">arrow_back</span>',
            'next_text' => '<span class="material-symbols-outlined">arrow_forward</span>',
        ]);
        if ($links) : ?>
          <nav class="flex flex-wrap justify-center gap-2 mt-12" aria-label="Pagination">
            <?php foreach ($links as $link) {
                echo $link;
            } ?>
          </nav>
        <?php endif; ?>

      <?php else : ?>

        <div class="bg-surface-container-lowest border-2 border-on-surface shadow-[4px_4px_0px_#121212] p-10 text-center">
          <h2 class="text-headline-md font-headline-md uppercase mb-2">Nothing here yet</h2>
          <p class="text-body-md text-on-surface-variant mb-6">No products match your filters.</p>
          <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="inline-block bg-primary-container text-surface border-2 border-on-surface px-6 py-3 text-label-lg font-label-lg font-extrabold uppercase shadow-[3px_3px_0px_#121212]">Back to shop</a>
        </div>

      <?php endif; ?>

    </div>
  </div>
</main>

<?php get_footer(); ?>