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
    $target = get_theme_mod('headless_redirect_uri');

    if (!is_privileged() && ! is_embeded_mode() && !empty($target)) {
        header('Location: ' . $target, true, 302);
    }

    if (is_embeded_mode()) {
        if ($target) {
            header("Content-Security-Policy: frame-ancestors 'self' {$target};");
        }

        ob_start();
    }
?>

<?php if (!is_headless() || is_embeded_mode() || is_privileged()): ?>
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
            <?php else:
                /**
                 * We can ignore the wp_enqueue_scripts error
                 * here as we're not actually loading any wordpress
                 * header tags. So it's okay to hardcode this
                 * for that one 401 screen.
                 */
            ?>
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

<?php endif; ?>
