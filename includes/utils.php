<?php
/**
 * Utility functions.
 *
 * @package @nordcom/betheme-wordpress-headless-theme
 * @author Nordcom Group Inc.
 * @link https://nordcom.io/
 */

function is_embeded_mode(): bool {
    return get_theme_mod("headless_embeded_enable", true) &&
        !(get_query_var('iframe', null) === null);
}

function is_headless(): bool {
    return !defined('DOING_CRON') &&
        !defined('DOING_CRON') &&
        !is_admin() &&
        !defined('GRAPHQL_HTTP_REQUEST') &&
        get_theme_mod("headless_enable", true);
}

function is_privileged(): bool {
    return (current_user_can('administrator') || current_user_can('editor'));
}
