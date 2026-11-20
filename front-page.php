<?php
get_header();

// Hero card: first featured product
$featured = wc_get_products(['featured' => true, 'limit' => 1, 'status' => 'publish']);
$hero     = $featured ? $featured[0] : null;

// Best sellers
$best_sellers = wc_get_products(['limit' => 4, 'status' => 'publish', 'orderby' => 'popularity', 'order' => 'DESC']);

$categories = [
    ['slug' => 'hoodies',   'title' => 'Heavyweight Hoodies & Sweats', 'badge' => 'MOST WANTED', 'badge_class' => 'bg-secondary-container text-surface -rotate-2'],
    ['slug' => 'tees',      'title' => 'Graphic Tees & Longsleeves',   'badge' => 'DROP 04',     'badge_class' => 'bg-tertiary-fixed text-on-tertiary-fixed rotate-2'],
    ['slug' => 'outerwear', 'title' => 'Technical Outerwear & Bombers', 'badge' => 'WATERPROOF',  'badge_class' => 'bg-primary-container text-surface -rotate-1'],
    ['slug' => 'bottoms',   'title' => 'Parachute Pants & Cargoes',    'badge' => 'RESTOCKED',   'badge_class' => 'bg-on-surface text-surface rotate-1'],
];

$values = [
    ['icon' => 'architecture',       'icon_class' => 'bg-primary-container text-surface',            'label' => 'STANDARD 01', 'label_class' => 'text-secondary', 'title' => 'HEAVYWEIGHT CRAFT', 'text' => '450-500GSM custom knit Japanese fleece and 300GSM ringspun organic cotton built to outlast trend cycles and heavy concrete abrasion.', 'check' => 'Zero shrinkage guarantee'],
    ['icon' => 'hourglass_disabled', 'icon_class' => 'bg-secondary-container text-surface',          'label' => 'STANDARD 02', 'label_class' => 'text-primary',   'title' => 'ZERO DEADSTOCK',     'text' => 'Strict micro-batch manufacturing. Every drop is produced in numbered runs. Once a silhouette is marked archived, it never enters production again.', 'check' => 'Individual serialized garment tag'],
    ['icon' => 'verified_user',      'icon_class' => 'bg-tertiary-fixed text-on-tertiary-fixed',     'label' => 'STANDARD 03', 'label_class' => 'text-on-tertiary-fixed-variant', 'title' => '30-DAY STREET TEST', 'text' => 'Wear it, skate it, live in it. Free worldwide returns and painless size exchanges with prepaid drop-off labels provided in every box.', 'check' => '100% money back guarantee'],
];

$strip_blue   = ['STREET READY', 'HEAVYWEIGHT ARCHITECTURE', 'NON-CONFORMIST CUTS', 'ACID WASH FINISH', 'UNISEX SILHOUETTE'];
$strip_yellow = ['NO DEADSTOCK', 'DROP CULTURE EXCLUSIVE', 'WORLDWIDE DISPATCH WITHIN 24H', 'ZERO FAST FASHION', 'LOCKED IN CODE'];
$shop_url     = wc_get_page_permalink('shop');
?>

<main>

  <!-- HERO -->
  <div class="max-w-[1440px] mx-auto px-6 lg:px-8 pt-8 pb-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">

      <div class="lg:col-span-7 flex flex-col gap-6">
        <div class="inline-flex items-center gap-2 self-start bg-tertiary-fixed text-on-tertiary-fixed border-2 border-on-surface px-3 py-1 -rotate-2 shadow-[2px_2px_0px_#121212] text-label-md font-label-md uppercase tracking-wider font-extrabold">
          <span class="w-2.5 h-2.5 rounded-full bg-secondary-container border border-on-surface animate-ping"></span>
          NEW DROP ONLINE / ACID MATRIX RUN 04
        </div>

        <h1 class="text-[44px] leading-[48px] md:text-display-xl font-display-xl text-on-surface uppercase tracking-tight">
          WEAR IT <span class="bg-secondary-container text-surface px-2 border-2 border-on-surface inline-block shadow-[4px_4px_0px_#121212] -rotate-1">LOUD.</span>
          <br>
          <span class="text-primary-container underline decoration-on-surface decoration-4">ZERO</span> BORING
          <br>
          <span class="relative inline-block mt-2">
            CLOTHES.
            <span class="absolute -bottom-2 left-0 right-0 h-3 bg-tertiary-fixed -z-10 border border-on-surface"></span>
          </span>
        </h1>

        <p class="text-body-lg font-body-lg text-on-surface-variant max-w-xl border-l-4 border-primary-container pl-4 py-1">
          Underground cuts, 480GSM heavyweight Japanese fleece, and boundary-pushing graphics made for the concrete playground. Built to survive wear and wash.
        </p>

        <div class="flex flex-wrap items-center gap-4 pt-2">
          <a href="<?php echo esc_url($shop_url); ?>" class="bg-primary-container hover:bg-secondary-container text-on-primary-container border-3 border-on-surface px-8 py-4 text-headline-sm font-headline-sm uppercase tracking-wider shadow-[4px_4px_0px_#121212] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none inline-flex items-center gap-3">
            SHOP THE NEW DROP
            <span class="material-symbols-outlined font-extrabold">arrow_forward</span>
          </a>
        </div>

        <div class="flex flex-wrap items-center gap-6 pt-4 text-label-md font-label-md uppercase tracking-tight text-on-surface">
          <div class="flex items-center gap-1.5 font-bold"><span class="material-symbols-outlined text-primary font-bold">verified</span> Custom milled fleece</div>
          <div class="flex items-center gap-1.5 font-bold"><span class="material-symbols-outlined text-secondary font-bold">local_shipping</span> Express worldwide drop</div>
          <div class="flex items-center gap-1.5 font-bold"><span class="material-symbols-outlined text-tertiary font-bold">recycling</span> 100% Bio-cotton</div>
        </div>
      </div>

      <?php if ($hero) : ?>
        <div class="lg:col-span-5 relative mt-6 lg:mt-0">
          <div class="absolute -top-6 -right-3 z-20 bg-secondary-container text-surface border-2 border-on-surface px-4 py-2 font-headline-sm text-headline-sm uppercase tracking-tight shadow-[4px_4px_0px_#121212] rotate-3 font-extrabold flex items-center gap-1">
            <span class="material-symbols-outlined font-extrabold">local_fire_department</span>
            LIMITED DROP
          </div>

          <div class="bg-surface-container-lowest border-3 border-on-surface shadow-[8px_8px_0px_#121212] p-4 relative">
            <div class="flex justify-between items-center pb-3 border-b-2 border-on-surface mb-3">
              <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-secondary-container border border-on-surface inline-block"></span>
                <span class="w-3 h-3 rounded-full bg-tertiary-fixed border border-on-surface inline-block"></span>
                <span class="w-3 h-3 rounded-full bg-primary-container border border-on-surface inline-block"></span>
                <span class="text-label-sm font-label-sm font-extrabold uppercase ml-1">DROP_04//EDITION_A</span>
              </div>
              <span class="bg-surface-variant text-on-surface border border-on-surface px-2 py-0.5 text-label-sm font-label-sm font-bold">LIMITED ARCHIVE</span>
            </div>

            <a href="<?php echo esc_url($hero->get_permalink()); ?>" class="relative block bg-surface-variant border-2 border-on-surface h-[380px] overflow-hidden">
              <?php echo $hero->get_image('large', ['class' => 'w-full h-full object-cover']); ?>
              <span class="price absolute bottom-3 right-3 bg-surface-container-lowest text-on-surface border-2 border-on-surface px-3 py-1 text-headline-md font-headline-md font-extrabold shadow-[3px_3px_0px_#121212]">
                <?php echo wp_kses_post($hero->get_price_html()); ?>
              </span>
            </a>

            <div class="pt-4 flex justify-between items-center gap-3">
              <div>
                <p class="text-label-sm font-label-sm text-on-surface-variant font-extrabold uppercase">Hero Highlight Piece</p>
                <h2 class="text-headline-sm font-headline-sm text-on-surface uppercase"><?php echo esc_html($hero->get_name()); ?></h2>
              </div>
              <?php
              echo loop_wear_add_to_cart_link(
                  $hero,
                  'bg-primary-container text-surface hover:bg-secondary-container border-2 border-on-surface p-2.5 shadow-[3px_3px_0px_#121212] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none flex items-center justify-center',
                  '<span class="material-symbols-outlined font-extrabold">add_shopping_cart</span>'
              );
              ?>
            </div>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </div>

  <!-- MARQUEE STRIPS -->
  <section class="border-y-3 border-on-surface overflow-hidden">
    <div class="bg-primary-container py-3 border-b-2 border-on-surface select-none">
      <div class="animate-marquee-infinite whitespace-nowrap text-on-primary-container font-display-lg text-headline-lg uppercase font-extrabold tracking-tight">
        <?php for ($i = 0; $i < 2; $i++) : ?>
          <span class="flex items-center gap-6 px-6">
            <?php foreach ($strip_blue as $k => $text) : ?>
              <span><?php echo esc_html($text); ?></span>
              <span class="material-symbols-outlined <?php echo $k % 2 ? 'text-secondary-container' : 'text-tertiary-fixed'; ?>">star</span>
            <?php endforeach; ?>
          </span>
        <?php endfor; ?>
      </div>
    </div>
    <div class="bg-tertiary-fixed py-2 select-none">
      <div class="animate-marquee-reverse whitespace-nowrap text-on-tertiary-fixed font-headline-sm text-headline-sm uppercase font-extrabold tracking-wider">
        <?php for ($i = 0; $i < 2; $i++) : ?>
          <span class="flex items-center gap-6 px-6">
            <?php foreach ($strip_yellow as $text) : ?>
              <span><?php echo esc_html($text); ?></span> <span>•</span>
            <?php endforeach; ?>
          </span>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <!-- CATEGORIES -->
  <section class="max-w-[1440px] mx-auto px-6 lg:px-8 py-16">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4 border-b-2 border-on-surface pb-4">
      <div>
        <div class="bg-on-surface text-surface px-2.5 py-0.5 text-label-sm font-label-sm font-extrabold uppercase inline-block mb-2">CURATED COLLECTIONS</div>
        <h2 class="text-headline-lg font-headline-lg text-on-surface uppercase tracking-tight">CATEGORIES // EXPLORE BY SILHOUETTE</h2>
      </div>
      <a href="<?php echo esc_url($shop_url); ?>" class="flex items-center gap-2 text-headline-sm font-headline-sm text-primary uppercase font-bold hover:text-secondary group">
        <span>VIEW ALL DEPARTMENTS</span>
        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_outward</span>
      </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ($categories as $i => $c) :
          $term = get_term_by('slug', $c['slug'], 'product_cat');
          if (!$term) {
              continue;
          }

          // Category image, or fallback to the first product image in it
          $thumb_id = (int) get_term_meta($term->term_id, 'thumbnail_id', true);
          if (!$thumb_id) {
              $ids      = wc_get_products(['category' => [$term->slug], 'limit' => 1, 'return' => 'ids']);
              $thumb_id = $ids ? (int) get_post_thumbnail_id($ids[0]) : 0;
          }
          ?>
        <a href="<?php echo esc_url(get_term_link($term)); ?>" class="group bg-surface-container-lowest border-2 border-on-surface p-4 shadow-[4px_4px_0px_#121212] hover:shadow-[8px_8px_0px_#121212] hover:-translate-y-1 transition-all flex flex-col justify-between">
          <div>
            <div class="flex justify-between items-center mb-3">
              <span class="<?php echo esc_attr($c['badge_class']); ?> border-2 border-on-surface px-2.5 py-1 text-label-sm font-label-sm font-extrabold uppercase">
                <?php echo esc_html($c['badge']); ?>
              </span>
              <span class="text-label-sm font-label-sm font-bold text-on-surface-variant">
                <?php echo esc_html(sprintf('%02d // %02d STYLES', $i + 1, $term->count)); ?>
              </span>
            </div>
            <div class="bg-surface-container-high border-2 border-on-surface h-64 overflow-hidden mb-4 [&_img]:w-full [&_img]:h-full [&_img]:object-cover [&_img]:group-hover:scale-105 [&_img]:transition-transform [&_img]:duration-300">
              <?php echo $thumb_id ? wp_get_attachment_image($thumb_id, 'large') : wc_placeholder_img('large'); ?>
            </div>
          </div>
          <div class="border-t-2 border-on-surface pt-3 flex justify-between items-center gap-2">
            <h3 class="text-headline-sm font-headline-sm text-on-surface uppercase group-hover:text-primary"><?php echo esc_html($c['title']); ?></h3>
            <span class="material-symbols-outlined text-on-surface bg-surface-variant p-1 border border-on-surface">arrow_forward</span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- BEST SELLERS -->
  <section class="bg-surface-container-lowest border-y-3 border-on-surface py-16">
    <div class="max-w-[1440px] mx-auto px-6 lg:px-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
        <div>
          <div class="flex items-center gap-2 mb-2">
            <span class="w-3 h-3 bg-secondary-container border border-on-surface"></span>
            <span class="text-label-sm font-label-sm font-extrabold tracking-wider uppercase text-on-surface-variant">HOT DROPS &amp; CORE RELEASES</span>
          </div>
          <h2 class="text-headline-lg font-headline-lg text-on-surface uppercase tracking-tight">BEST SELLERS // ZERO FILLER</h2>
        </div>
        <a href="<?php echo esc_url($shop_url); ?>" class="bg-primary-container text-surface border-2 border-on-surface px-5 py-2 text-label-lg font-label-lg uppercase font-bold shadow-[3px_3px_0px_#121212] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
          SHOP ALL
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($best_sellers as $p) {
            get_template_part('template-parts/product-card', null, ['product' => $p]);
        } ?>
      </div>
    </div>
  </section>

  <!-- BRAND VALUES -->
  <section class="max-w-[1440px] mx-auto px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <?php foreach ($values as $v) : ?>
        <div class="bg-surface-container-lowest border-3 border-on-surface p-8 shadow-[6px_6px_0px_#121212] flex flex-col gap-4">
          <div class="w-14 h-14 <?php echo esc_attr($v['icon_class']); ?> border-2 border-on-surface flex items-center justify-center shadow-[3px_3px_0px_#121212]">
            <span class="material-symbols-outlined text-3xl font-extrabold"><?php echo esc_html($v['icon']); ?></span>
          </div>
          <div class="text-label-sm font-label-sm font-extrabold uppercase tracking-widest <?php echo esc_attr($v['label_class']); ?>"><?php echo esc_html($v['label']); ?></div>
          <h3 class="text-headline-md font-headline-md text-on-surface uppercase tracking-tight"><?php echo esc_html($v['title']); ?></h3>
          <p class="text-body-md font-body-md text-on-surface-variant"><?php echo esc_html($v['text']); ?></p>
          <div class="pt-2 text-label-sm font-label-sm font-bold uppercase flex items-center gap-1 text-on-surface">
            <span class="material-symbols-outlined text-[18px] text-primary">check_circle</span>
            <?php echo esc_html($v['check']); ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- NEWSLETTER (static for now) -->
  <section class="max-w-[1440px] mx-auto px-6 lg:px-8 pb-20">
    <div class="bg-tertiary-fixed border-3 border-on-surface shadow-[8px_8px_0px_#121212] p-8 md:p-14 relative overflow-hidden">
      <div class="absolute -top-3 right-6 bg-secondary-container text-surface border-2 border-on-surface px-4 py-1.5 font-label-md text-label-md uppercase font-extrabold rotate-3 shadow-[3px_3px_0px_#121212]">
        NO SPAM EVER, ONLY HEAT
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        <div class="lg:col-span-7 flex flex-col gap-3">
          <div class="inline-flex items-center gap-2 bg-on-surface text-surface px-3 py-1 font-label-sm text-label-sm font-bold uppercase self-start">
            <span class="material-symbols-outlined text-[16px] text-tertiary-fixed">key</span>
            SECRET DROP ACCESS
          </div>
          <h2 class="text-4xl md:text-display-lg font-display-lg text-on-tertiary-fixed uppercase leading-none tracking-tight">
            GET 15% OFF + <br><span class="underline decoration-on-surface decoration-4">VIP DROP ACCESS</span>
          </h2>
          <p class="text-body-lg font-body-lg text-on-tertiary-fixed max-w-lg font-medium">
            Join the inner Loop syndicate. Get password codes 1 hour before global releases, private warehouse links, and subscriber-only archive sales.
          </p>
        </div>

        <div class="lg:col-span-5">
          <form class="flex flex-col sm:flex-row gap-3" onsubmit="return false;">
            <input type="email" required placeholder="ENTER YOUR STREET EMAIL..." class="bg-surface-container-lowest text-on-surface border-2 border-on-surface px-4 py-4 text-body-md font-body-md focus:outline-none focus:ring-0 shadow-[4px_4px_0px_#121212] grow placeholder:text-on-surface-variant font-medium">
            <button type="submit" class="bg-primary-container text-surface hover:bg-secondary-container border-2 border-on-surface px-6 py-4 text-headline-sm font-headline-sm uppercase font-extrabold tracking-wider shadow-[4px_4px_0px_#121212] active:translate-x-[4px] active:translate-y-[4px] active:shadow-none whitespace-nowrap flex items-center justify-center gap-2">
              <span>JOIN THE LOOP</span>
              <span class="material-symbols-outlined">arrow_forward</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>