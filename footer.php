<?php
/**
 * Minimal footer, removes fluff while keeping everything needed
 * for previewing (when user is admin or editor).
 *
 * @package @nordcom/betheme-wordpress-headless-theme
 * @author Nordcom Group Inc.
 * @link https://nordcom.io/
 */
?>

<?php if (current_user_can('administrator') || current_user_can('editor')): ?>
    <?php require_once get_template_directory()  . '/footer.php'; ?>
<?php else: ?>
</body>
</html>
<?php endif; ?>
