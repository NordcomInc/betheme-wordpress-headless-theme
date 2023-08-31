<?php
/**
 * Menu handling, functions and filters.
 *
 * @package @nordcom/betheme-wordpress-headless-theme
 * @author Nordcom Group Inc.
 * @link https://nordcom.io/
 */

// Register headless menus
register_nav_menu('authenticated-main-menu', __('Authenticated Main Menu', 'betheme-wordpress-headless-theme'));
register_nav_menu('unauthenticated-main-menu', __('Unauthenticated Main Menu', 'betheme-wordpress-headless-theme'));

// Functions we're required to stub
function mfn_wp_nav_menu() { return null; }
function mfn_wp_page_menu() { return null; }
function mfn_wp_mobile_menu() { return null; }
function mfn_wp_split_menu() { return null; }
function mfn_wp_overlay_menu() { return null; }
function mfn_wp_secondary_menu() { return null; }
function mfn_wp_lang_menu() { return null; }
function mfn_wp_social_menu() { return null; }
function mfn_wp_social_menu_bottom() { return null; }
function mfn_wp_accessibility_skip_links() { return null; }
