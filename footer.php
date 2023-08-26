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

<?php if (!is_headless() || is_embeded_mode() || is_privileged()): ?>
    <?php require_once get_template_directory()  . '/footer.php'; ?>
<?php else: ?>
    </body>
</html>
<?php endif; ?>

<?php
    if (!is_embeded_mode())
        die();

    $contents = ob_get_contents();
    ob_end_clean();

    $doc = new DOMDocument();
    $doc->loadHTML($contents);

    foreach ($doc->getElementsByTagName('body') as $body) {
        $body->setAttribute('class', $body->getAttribute('class') . ' embeded');
    }

    $removable = [
        'wpadminbar',
        'Header_wrapper',
        'Footer',
        'body_overlay',
        'back_to_top',
        'comments',

        'comment-reply-js',
        'mfn-debouncedresize-js',
        'mfn-magnificpopup-js',
        'ihc-jquery_upload_file-footer-js',
        'mec-owl-carousel-script-js',

        'jquery-ui-datepicker-js-after',

        'core-block-supports-inline-css',
        'bp-login-form-block-css',
        'bp-member-block-css',
        'bp-members-block-css',
        'bp-dynamic-members-block-css',
        'mfn-fonts-css'
    ];
    foreach($removable as $target){
        $taget_tag = $doc->getElementById($target);
        if (!$taget_tag)
            continue;

        $taget_tag->parentNode->removeChild($taget_tag);
    }

    echo $doc->saveHTML();
