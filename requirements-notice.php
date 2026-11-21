<?php
defined('ABSPATH') || exit;

status_header(503);
nocache_headers();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class('bg-surface-container text-on-surface font-body-md'); ?>>

<main class="min-h-screen flex items-center justify-center p-6">
  <div class="bg-surface-container-lowest border-3 border-on-surface shadow-[6px_6px_0px_#121212] p-8 max-w-lg text-center">
    <h1 class="text-headline-md font-headline-md uppercase mb-2">Store unavailable</h1>
    <p class="text-body-md text-on-surface-variant">This site needs WooCommerce to work. Please come back later.</p>
  </div>
</main>

<?php wp_footer(); ?>
</body>
</html>