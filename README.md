# Loop Wear

Custom WooCommerce theme for a demo streetwear store.

**Live demo:** https://YOUR-DEMO-URL
This is a demo store. Orders are not processed and nothing is shipped.

![Home](docs/screenshots/home.png)

## About

A classic PHP theme written from scratch for WooCommerce. The design (a neo-brutalist streetwear store) was drafted in Google Stitch. The theme code, template overrides and WooCommerce integration were written by hand.

The project exists to practice and show WooCommerce theme development: template overrides, hooks and filters, AJAX fragments, and a Tailwind build pipeline.

## Stack

- WordPress 5.7+, WooCommerce, PHP 7.4+
- Tailwind CSS 3 (CLI) with `@tailwindcss/forms`
- Vanilla JavaScript, no jQuery of its own
- Google Fonts (Bricolage Grotesque, DM Sans), Material Symbols

## Features

- **Home:** hero, category cards and best sellers are built from WooCommerce data
- **Catalog:** category tree, price filter, sorting, pagination (one template for shop, categories and search)
- **Product page:** custom gallery, variable products, tabs, reviews, related products
- **Cart and checkout:** overridden classic templates, coupon support, styled Select2 and payment methods
- **My account:** dashboard, navigation, orders, addresses, account details
- **Free shipping progress bar:** the threshold is read from the free shipping method of the matching shipping zone, not hardcoded
- **Cart counter:** updates without reload through WooCommerce fragments
- **Mobile menu:** accessible toggle (aria attributes, Escape to close)
- **Demo mode:** top banner, checkout warning, `noindex`. Can be switched off with a constant

## Project structure

```
loop-wear/
├── assets/
│   ├── css/main.css              compiled CSS (committed)
│   └── js/theme.js               mobile menu
├── inc/
│   ├── setup.php                 theme supports, menus
│   ├── enqueue.php               styles, scripts, resource hints
│   ├── navigation.php            menu link classes
│   ├── woocommerce.php           cart fragments, catalog settings
│   ├── free-shipping-bar.php     free shipping progress bar
│   └── demo.php                  demo mode
├── src/input.css                 Tailwind source
├── template-parts/product-card.php
├── woocommerce/                  template overrides
│   ├── archive-product.php
│   ├── single-product.php
│   ├── cart/
│   ├── checkout/
│   └── myaccount/
├── front-page.php, page.php, index.php
├── header.php, footer.php, functions.php, style.css
├── tailwind.config.js
└── package.json
```

## Setup

1. Copy the theme to `wp-content/themes/loop-wear` and activate it.
2. Install and activate WooCommerce.
3. Set permalinks to "Post name".
4. Cart and checkout must use shortcodes, not blocks:
   ```
   wp post update <cart_page_id> --post_content='[woocommerce_cart]'
   wp post update <checkout_page_id> --post_content='[woocommerce_checkout]'
   ```
5. Create a "Primary Menu" and assign it to the "Primary Menu" location.
6. Create product categories with these slugs for the home page cards: `hoodies`, `tees`, `outerwear`, `bottoms`. Missing categories are skipped. Mark one product as featured for the hero card.
7. For the free shipping bar, add a Free shipping method with "A minimum order amount" to your shipping zone.

## Development

Requires Node.js 18+.

```
npm install
npm run dev      # watch and rebuild assets/css/main.css
npm run build    # minified build for deployment
```

The compiled `assets/css/main.css` is committed, so the theme can be deployed to a host without Node. Run `npm run build` before every deploy.

## Demo mode

Demo mode is on by default. To turn it off, add to `wp-config.php`:

```php
define('LOOP_WEAR_DEMO', false);
```

## Decisions and trade-offs

- **WooCommerce default styles are disabled.** All styling is done in Tailwind. The cost: every plugin UI element (notices, Select2, review stars) needs its own CSS.
- **Classic templates with shortcodes instead of Cart/Checkout blocks.** This gives full control over the markup. Blocks are the direction WooCommerce is moving in, so this is a trade-off, not a recommendation.
- **Small PHP modules in `inc/`.** `functions.php` only requires them. Hooks use named functions with a `loop_wear_` prefix, so they can be unhooked.

## Known limitations

- Variation options are dropdowns, not swatches
- The product gallery does not switch to a variation's own image
- The newsletter form is static
- English only, no translation files
- No automated tests, checked manually

## Credits

Design drafted in Google Stitch. Product images come from that mockup and are used for demonstration only. Icons: Material Symbols. Fonts: Google Fonts.