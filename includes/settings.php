<?php
/**
 * Handle everything related to settings and the
 * theme customizer.
 *
 * @package @nordcom/betheme-wordpress-headless-theme
 * @author Nordcom Group Inc.
 * @link https://nordcom.io/
 */

function nordcom_theme_settings_headless_init($wp_customize) {
    $wp_customize->add_section('headless', array(
        'priority' => 0,
        'title' => __('Headless configuration', 'betheme-wordpress-headless-theme'),
        'description' => "Configure this headless theme to best suit your needs.",
    ));

    $wp_customize->add_setting('headless_enable', array(
        'default' => true,
        'capability' => 'edit_theme_options'
    ));
    $wp_customize->add_control('headless_enable', array(
        'label' => __('Enable Headless Mode', 'betheme-wordpress-headless-theme'),
        'description' => 'If disabled, the site will be rendered normally.',
        'section' => 'headless',
        'type' => 'checkbox'
    ));

    $wp_customize->add_setting('headless_redirect_uri', array(
        'default' => '',
        'capability' => 'edit_theme_options'
    ));
    $wp_customize->add_control('headless_redirect_uri', array(
        'label' => __('Target URI', 'betheme-wordpress-headless-theme'),
        'description' => 'URL including protocol, e.g. https://example.com. Defaults to a 401 page if empty.',
        'section' => 'headless',
        'type' => 'url'
    ));

    $wp_customize->add_setting('headless_embeded_enable', array(
        'default' => true,
        'capability' => 'edit_theme_options'
    ));
    $wp_customize->add_control('headless_embeded_enable', array(
        'label' => __('Enable Embedding Pages', 'betheme-wordpress-headless-theme'),
        'description' => "With the enabled pages will render in a no layout mode when
            you pass `iframe` as a query parammeter to any page. NOTE: This bypasses
            the headless redirection as it's indeded to be embeded in an iframe.",
        'section' => 'headless',
        'type' => 'checkbox'
    ));
}
add_action('customize_register', 'nordcom_theme_settings_headless_init');
