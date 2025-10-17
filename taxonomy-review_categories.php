<?php
/**
 * Review Categories Taxonomy Template
 * Used for review category archives
 */

if (!defined('ABSPATH')) exit;

get_header();
?>

<main id="main" class="site-main">

    <?php get_template_part('inc/page-heading'); ?>
    
    <div class="container">
        
        <?php if (have_posts()) : ?>
            
            
            <div class="posts-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('inc/post-card');
                endwhile;
                ?>
            </div>
            
            <?php get_template_part('inc/pagination'); ?>
            
        <?php else : ?>
            
            <?php get_template_part('inc/no-results'); ?>
            
        <?php endif; ?>
        
    </div>
</main>

<?php
get_footer();

