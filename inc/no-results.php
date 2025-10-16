<?php
/**
 * No Results Template Partial
 * Displays message when no posts are found
 */

if (!defined('ABSPATH')) exit;
?>

<div class="no-results">
    <h2><?php _e('Nothing Found', 'balefire'); ?></h2>
    
    <?php if (is_search()) : ?>
        <p><?php _e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'balefire'); ?></p>
    <?php else : ?>
        <p><?php _e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'balefire'); ?></p>
    <?php endif; ?>
    
    <div class="search-form-wrapper">
        <?php get_search_form(); ?>
    </div>
</div>

