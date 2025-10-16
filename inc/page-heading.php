<?php
/**
 * Page Heading Template
 * Displays contextual H1 heading based on page type
 * 
 * Usage: get_template_part('inc/page-heading');
 * 
 * @package Balefire
 */

if (!defined('ABSPATH')) exit;
?>

<header class="page-header">
    <?php if (is_singular()) : ?>
        
        <!-- Single Post/Page/CPT -->
        <h1 class="page-title"><?php the_title(); ?></h1>
        
    <?php elseif (is_search()) : ?>
        
        <!-- Search Results -->
        <h1 class="page-title">
            <?php printf(__('Search Results for: %s', 'balefire'), '<span>' . get_search_query() . '</span>'); ?>
        </h1>
        
    <?php elseif (is_404()) : ?>
        
        <!-- 404 Page -->
        <h1 class="page-title"><?php _e('Page Not Found', 'balefire'); ?></h1>
        
    <?php elseif (is_archive()) : ?>
        
        <!-- Archive Pages -->
        <?php
        the_archive_title('<h1 class="page-title">', '</h1>');
        ?>
        
    <?php elseif (is_home()) : ?>
        
        <!-- Blog Index -->
        <h1 class="page-title">
            <?php 
            // Check if there's a static blog page set
            if (get_option('page_for_posts')) {
                echo get_the_title(get_option('page_for_posts'));
            } else {
                _e('Blog', 'balefire');
            }
            ?>
        </h1>
        
    <?php else : ?>
        
        <!-- Fallback -->
        <h1 class="page-title"><?php wp_title(''); ?></h1>
        
    <?php endif; ?>
</header>

