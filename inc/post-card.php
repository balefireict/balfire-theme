<?php
/**
 * Post Card Template Partial
 * Default card layout for grid displays
 */

if (!defined('ABSPATH')) exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
    <div class="post-thumbnail">
        <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('medium'); ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/no-image.svg" alt="<?php the_title_attribute(); ?>" />
            <?php endif; ?>
        </a>
    </div>
    
    <div class="post-content">
        <?php
        $categories = get_the_category();
        if ($categories) : ?>
            <div class="post-categories">
                <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                    <?php echo esc_html($categories[0]->name); ?>
                </a>
            </div>
        <?php endif; ?>
        
        <h2 class="post-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
        
        <div class="post-meta">
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                <?php echo get_the_date(); ?>
            </time>
        </div>
        
        <div class="post-excerpt">
            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
        </div>
        
        <a href="<?php the_permalink(); ?>" class="btn read-more">
            <?php _e('Read More', 'balefire'); ?>
        </a>
    </div>
</article>

