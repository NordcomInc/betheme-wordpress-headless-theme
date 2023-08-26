<?php
/**
 * Theme setup.
 *
 * @package @nordcom/betheme-wordpress-headless-theme
 * @author Nordcom Group Inc.
 * @link https://nordcom.io/
 */

require get_stylesheet_directory() . '/includes/utils.php';
require get_stylesheet_directory() . '/includes/settings.php';

if (!function_exists('nordcom_theme_head')) {
    function nordcom_theme_head() {
        echo '<meta name="robots" content="noindex" />';
    }
}
add_action('wp_head', 'nordcom_theme_head');

if (!function_exists('nordcom_theme_enqueue_styles')) {
    function nordcom_theme_enqueue_styles() {
        if (!is_embeded_mode())
            return;

        wp_enqueue_style('nordcom_theme-style',
            get_stylesheet_uri(),
            array(),
            wp_get_theme()->get('Version')
        );
    }
}
add_action('wp_enqueue_scripts', 'nordcom_theme_enqueue_styles');

if (get_theme_mod("headless_embeded_enable", true)) {
    if (!function_exists('nordcom_theme_query_vars')) {
        function nordcom_theme_query_vars($vars) {
            $vars[] = "iframe";
            return $vars;
        }
    }
    add_filter('query_vars', 'nordcom_theme_query_vars');
    get_query_var('iframe');
}
