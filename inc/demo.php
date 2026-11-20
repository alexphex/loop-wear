<?php
defined('ABSPATH') || exit;

/**
 * Demo mode: this site is a portfolio project, not a real store.
 * ON by default. To switch it off, add to wp-config.php:
 *   define('LOOP_WEAR_DEMO', false);
 */
function loop_wear_is_demo() {
    return !defined('LOOP_WEAR_DEMO') || LOOP_WEAR_DEMO;
}

/**
 * Banner at the very top of every page (printed from header.php).
 */
function loop_wear_demo_banner() {
    if (!loop_wear_is_demo()) {
        return;
    }
    ?>
    <div class="bg-secondary-container border-b-2 border-on-surface text-on-surface" role="note">
      <p class="max-w-[1440px] mx-auto px-4 py-2 flex flex-wrap items-center justify-center gap-x-3 gap-y-1 text-center text-label-md font-label-md uppercase font-bold">
        <span class="inline-flex items-center gap-1">
          <span class="material-symbols-outlined text-[18px]">science</span> Demo store
        </span>
        <span>Portfolio project for demonstration only. Orders are not processed and nothing will be shipped.</span>
      </p>
    </div>
    <?php
}

/**
 * Warning above the checkout form.
 */
function loop_wear_demo_checkout_notice() {
    if (!loop_wear_is_demo()) {
        return;
    }

    wc_print_notice('This is a demo store. Please do not enter real personal or payment details. Orders are not processed.', 'notice');
}
add_action('woocommerce_before_checkout_form', 'loop_wear_demo_checkout_notice', 5);

/**
 * Keep the demo out of search engines.
 */
function loop_wear_demo_robots($robots) {
    return loop_wear_is_demo() ? wp_robots_no_robots($robots) : $robots;
}
add_filter('wp_robots', 'loop_wear_demo_robots');