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
        'title' => 'Headless configuration',
        'description' => "Configure this headless theme to best suit your needs.",
    ));

    $wp_customize->add_setting('headless_enable', array(
        'default' => true,
        'capability' => 'edit_theme_options'
    ));
    $wp_customize->add_control('headless_enable', array(
        'label' => __('Enable Headless Mode', 'wp-graphql-bebuilder'),
        'description' => 'If disabled, the site will be rendered normally.',
        'section' => 'headless',
        'type' => 'checkbox'
    ));

    $wp_customize->add_setting('headless_redirect_uri', array(
        'default' => '',
        'capability' => 'edit_theme_options'
    ));
    $wp_customize->add_control('headless_redirect_uri', array(
        'label' => 'Target URI',
        'description' => 'URL including protocol, e.g. https://example.com. Defaults to a 401 page if empty.',
        'section' => 'headless',
        'type' => 'url'
    ));
}
add_action('customize_register', 'nordcom_theme_settings_headless_init');
