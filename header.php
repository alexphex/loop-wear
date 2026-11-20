<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class('bg-surface-container text-on-surface antialiased selection:bg-secondary-container selection:text-surface-container-lowest font-body-md overflow-x-hidden'); ?>>
<?php wp_body_open(); ?>

<!-- Demo Banner -->
<?php loop_wear_demo_banner(); ?>

<?php
$marquee_items = [
    'DROP 04: ACID MATRIX LIVE NOW',
    'FREE WORLDWIDE SHIPPING OVER $100',
    '100% HEAVYWEIGHT ORGANIC COTTON',
    'LIMITED RUNS NO RESTOCKS',
    'CONCRETE TESTED',
];
?>

<!-- Announcement marquee -->
<section class="bg-tertiary-fixed border-b-2 border-on-surface overflow-hidden py-2 select-none relative z-50">
  <div class="animate-marquee-infinite whitespace-nowrap text-on-tertiary-fixed font-headline-sm text-headline-sm uppercase tracking-tight">
    <?php for ($i = 0; $i < 2; $i++) : ?>
      <span class="flex items-center gap-4 px-4 font-extrabold">
        <?php foreach ($marquee_items as $k => $text) : ?>
          <span class="material-symbols-outlined font-bold <?php echo $k % 2 ? 'text-primary' : 'text-secondary'; ?>">bolt</span>
          <?php echo esc_html($text); ?>
        <?php endforeach; ?>
      </span>
    <?php endfor; ?>
  </div>
</section>

<!-- Header -->
<header class="bg-surface border-b-2 border-on-surface shadow-[0px_4px_0px_#121212] sticky top-0 z-40">
  <div class="flex justify-between items-center w-full px-4 sm:px-6 py-4 max-w-[1440px] mx-auto">

    <!-- Logo -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="text-[20px] sm:text-headline-md font-headline-md font-extrabold uppercase tracking-tight text-on-surface flex items-center gap-2">
      <span class="w-8 h-8 bg-primary-container border-2 border-on-surface flex items-center justify-center shadow-[2px_2px_0px_#121212]">
        <span class="material-symbols-outlined text-on-primary-container font-extrabold">all_inclusive</span>
      </span>
      <span>LOOP WEAR</span>
    </a>

    <!-- Primary menu -->
    <?php
    wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'hidden md:flex items-center gap-8 text-label-lg font-label-lg',
        'fallback_cb'    => false,
        'depth'          => 1,
    ]);
    ?>

    <!-- Actions -->
    <div class="flex items-center gap-2 sm:gap-3">
      <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative hidden lg:flex items-center">
        <input type="hidden" name="post_type" value="product">
        <input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="Search archive, tags..." class="bg-surface-container-lowest text-body-sm font-body-sm text-on-surface border-2 border-on-surface px-3 py-1.5 pl-8 focus:outline-none focus:ring-0 shadow-[2px_2px_0px_#121212] w-48 focus:w-64 transition-all">
        <span class="material-symbols-outlined absolute left-2 text-on-surface-variant pointer-events-none text-[18px]">search</span>
      </form>

      <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" aria-label="My account" class="hidden sm:flex w-10 h-10 border-2 border-on-surface bg-surface-container-lowest items-center justify-center text-on-surface shadow-[2px_2px_0px_#121212] hover:bg-surface-container active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
        <span class="material-symbols-outlined">person</span>
      </a>

      <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="flex items-center gap-2 border-2 border-on-surface bg-secondary-container text-on-surface px-3 sm:px-4 py-2 text-label-lg font-label-lg font-extrabold shadow-[3px_3px_0px_#121212] hover:bg-tertiary-fixed active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
        <span class="material-symbols-outlined">shopping_bag</span>
        <span><span class="hidden sm:inline">Cart </span>(<?php echo loop_wear_cart_count(); ?>)</span>
      </a>

      <button type="button" id="menu-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu" class="md:hidden w-10 h-10 border-2 border-on-surface bg-surface-container-lowest flex items-center justify-center text-on-surface shadow-[2px_2px_0px_#121212] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
        <span class="material-symbols-outlined">menu</span>
      </button>
    </div>

  </div>

  <!-- Mobile menu -->
  <div id="mobile-menu" class="hidden md:hidden border-t-2 border-on-surface bg-surface">
    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="p-4 border-b-2 border-on-surface">
      <input type="hidden" name="post_type" value="product">
      <input type="search" name="s" placeholder="Search archive..." class="w-full bg-surface-container-lowest border-2 border-on-surface px-3 py-3 text-body-md focus:ring-0 focus:border-on-surface">
    </form>

    <?php
    wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'menu_id'        => 'mobile-nav',
        'menu_class'     => 'flex flex-col',
        'fallback_cb'    => false,
        'depth'          => 1,
    ]);
    ?>

    <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="flex items-center gap-2 px-6 py-4 text-headline-sm font-headline-sm uppercase hover:bg-tertiary-fixed">
      <span class="material-symbols-outlined">person</span> My account
    </a>
  </div>
</header>