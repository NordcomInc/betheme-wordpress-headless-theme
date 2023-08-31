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
require get_stylesheet_directory() . '/includes/overrides.php';

define('CHILD_THEME_URI', get_stylesheet_directory_uri());
define('WHITE_LABEL', true);

function nordcom_load_theme_textdomain() {
    load_theme_textdomain('betheme-wordpress-headless-theme', get_stylesheet_directory() .'/languages');
}
add_action('after_setup_theme', 'nordcom_load_theme_textdomain');


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

if (!function_exists('nordcom_disable_builtin')) {
    // Based on https://dykraf.com/blog/wordpress-set-up-for-different-home-url-and-site-url
    function nordcom_disable_builtin() {
        remove_action('wp_head', 'rest_output_link_wp_head');
        remove_action('wp_head', 'wp_resource_hints', 2);
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        remove_action('wp_head', 'wp_generator');

        function nordcom_disable_emojis_tinymce( $plugins ) {
            if (is_array($plugins))
                return array_diff($plugins, array('wpemoji'));
            
            return array();
        }
        add_filter('tiny_mce_plugins', 'nordcom_disable_emojis_tinymce');

        function nordcom_disable_emojis_dns( $urls, $relation_type ) {
            if ('dns-prefetch' === $relation_type) {
                /** This filter is documented in wp-includes/formatting.php */
                $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
                $urls = array_diff( $urls, array( $emoji_svg_url ) );
            }
        
            return $urls;
        }
        add_filter( 'wp_resource_hints', 'nordcom_disable_emojis_dns', 10, 2 );
    }
}
add_action('init', 'nordcom_disable_builtin');

if (!function_exists('nordcom_dequeue_builtin')) {
    function nordcom_dequeue_builtin(){
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
    }
}
add_action('wp_enqueue_scripts', 'nordcom_dequeue_builtin');

function nordcom_disable_admin_menus() {
    if(is_admin()){
        remove_menu_page('edit.php?post_type=client');
        remove_menu_page('edit.php?post_type=offer');
        remove_menu_page('edit.php?post_type=slide');
        remove_menu_page('edit.php?post_type=testimonial');
        remove_menu_page('edit.php?post_type=layout');
        remove_menu_page('edit.php?post_type=template');
    }
}

add_action('admin_menu', 'nordcom_disable_admin_menus', 999);
