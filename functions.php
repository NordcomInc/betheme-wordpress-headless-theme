<?php

/**
 * Theme setup.
 *
 * @package @nordcom/betheme-wordpress-headless-theme
 * @author Nordcom Group Inc.
 * @link https://nordcom.io/
 */

// require_once get_stylesheet_directory() . '/index.php';

require get_stylesheet_directory() . '/includes/settings.php';

if (!function_exists('nordcom_wp_setup')) {
    function nordcom_wp_setup() {
    }
}

add_action('after_setup_theme', 'nordcom_wp_setup');

