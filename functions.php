<?php
/**
 * Theme setup.
 *
 * @package @nordcom/betheme-wordpress-headless-theme
 * @author Nordcom Group Inc.
 * @link https://nordcom.io/
 */

require get_stylesheet_directory() . '/includes/settings.php';

if (!function_exists('nordcom_theme_enqueue_styles')) {
    function nordcom_theme_enqueue_styles() {
        if (!get_theme_mod("headless_enable", true)) {
            return;
        }

        wp_enqueue_style('nordcom_theme-style',
            get_stylesheet_uri(),
            array(),
            wp_get_theme()->get('Version')
        );
    }
}
add_action('wp_enqueue_scripts', 'nordcom_theme_enqueue_styles');
