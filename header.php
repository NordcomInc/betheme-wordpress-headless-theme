<?php
/**
 * Header that disables everything unless the user is signed in,
 * this is to allow for previewing posts if the frontend doesn't
 * support previewing.
 *
 * @package @nordcom/betheme-wordpress-headless-theme
 * @author Nordcom Group Inc.
 * @link https://nordcom.io/
 */

    $enabled = !defined('DOING_CRON') &&
        !defined('DOING_CRON') &&
        !is_admin() &&
        !defined('GRAPHQL_HTTP_REQUEST') &&
        get_theme_mod("headless_enable", true);

    $is_privileged = (current_user_can('administrator') || current_user_can('editor'));
    $target = get_theme_mod('headless_redirect_uri');

    if (!$is_privileged && !empty($target)) {
        header('Location: ' . $target, true, 302);
    }
?>

<?php if (!$enabled || $is_privileged): ?>
    <?php require_once get_template_directory()  . '/header.php'; ?>
<?php else: ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
        <head>
            <meta name="robots" content="noindex" />
            <meta charset="<?php bloginfo('charset'); ?>" />

            <?php if (!empty($target)): ?>
                <meta content="5;url=<?php echo esc_url($target); ?>" http-equiv="refresh"/>
                <script type="text/javascript">
                    window.location = '<?php echo esc_url($target); ?>';
                </script>
            <?php else: ?>
                <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
            <?php endif; ?>
        </head>
        <body>
            <?php if (!empty($target)): ?>
                <h1>Redirecting you to the new website...</h1>
                <p>Click <a href="<?php echo esc_url($target); ?>">here</a> you don't get redirected automatically.</p>
            <?php else: ?>
                <?php
                    status_header(401);
                ?>

                <h1>401: Unauthorized</h1>
                <h2>You are not permitted to view this page.</h2>
                <p>Click <a href="<?php echo esc_url(site_url('wp-login.php', 'login')); ?>">here</a> to login.</p>
            <?php endif; ?>

            <?php
                get_footer();
                /**
                 * First render the footer, then kill the rendering
                 * here to stop WordPress from loading the `index.php`
                 * file. This is needed as we for some reason can't
                 * just override it from a child theme. wtf.
                 */
                die();
            ?>

<?php endif;
