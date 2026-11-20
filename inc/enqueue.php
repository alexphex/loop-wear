<?php
defined('ABSPATH') || exit;

/**
 * File modification time as asset version: the browser cache is
 * busted automatically after every rebuild or deploy.
 */
function loop_wear_asset_version($relative_path) {
    $file = get_theme_file_path($relative_path);

    return file_exists($file) ? (string) filemtime($file) : null;
}

/**
 * Front-end styles and scripts.
 */
function loop_wear_enqueue_assets() {
    wp_enqueue_style(
        'loop-wear-fonts',
        'https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400..800&family=DM+Sans:opsz,wght@9..40,400..700&family=Material+Symbols+Outlined&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'loop-wear-main',
        get_theme_file_uri('assets/css/main.css'),
        ['loop-wear-fonts'],
        loop_wear_asset_version('assets/css/main.css')
    );

    wp_enqueue_script(
        'loop-wear-theme',
        get_theme_file_uri('assets/js/theme.js'),
        [],
        loop_wear_asset_version('assets/js/theme.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'loop_wear_enqueue_assets');

/**
 * Open connections to Google Fonts early (faster first paint).
 */
function loop_wear_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = [
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        ];
    }

    return $urls;
}
add_filter('wp_resource_hints', 'loop_wear_resource_hints', 10, 2);