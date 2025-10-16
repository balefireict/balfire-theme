<?php
/**
 * Archive Header Template Partial
 * Displays title, description, and post count for archives
 */

if (!defined('ABSPATH')) exit;

// Only show on archive pages
if (!is_archive() && !is_search() && !is_home()) {
    return;
}
?>

<header class="archive-header">
    <?php
    the_archive_title('<h1 class="archive-title">', '</h1>');
    the_archive_description('<div class="archive-description">', '</div>');
    
    // Optional: Show post count
    global $wp_query;
    $total = $wp_query->found_posts;
    if ($total > 0) {
        printf(
            '<p class="archive-count">%s</p>',
            sprintf(
                _n('%s post', '%s posts', $total, 'balefire'),
                number_format_i18n($total)
            )
        );
    }
    ?>
</header>

