<?php
/**
 * Partial: Post Card
 * Default card layout for grid displays
 * 
 * Available data via $partial_data:
 * - post_id (optional)
 * - show_thumbnail (bool)
 * - show_excerpt (bool)
 * - show_meta (bool)
 */

if (!defined('ABSPATH')) exit;

$data = get_query_var('partial_data', array());
$post_id = $data['post_id'] ?? get_the_ID();
$show_thumbnail = $data['show_thumbnail'] ?? true;
$show_excerpt = $data['show_excerpt'] ?? true;
$show_meta = $data['show_meta'] ?? true;
$thumbnail_size = $data['thumbnail_size'] ?? 'medium';

?>
<article id="post-<?php echo esc_attr($post_id); ?>" <?php post_class('post-card'); ?>>
    <?php if ($show_thumbnail && has_post_thumbnail($post_id)) : ?>
        <div class="post-thumbnail">
            <a href="<?php echo esc_url(get_permalink($post_id)); ?>" aria-hidden="true" tabindex="-1">
                <?php echo get_the_post_thumbnail($post_id, $thumbnail_size); ?>
            </a>
        </div>
    <?php endif; ?>
    
    <div class="post-content">
        <h2 class="post-title">
            <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                <?php echo esc_html(get_the_title($post_id)); ?>
            </a>
        </h2>
        
        <?php if ($show_meta) : ?>
            <div class="post-meta">
                <time datetime="<?php echo esc_attr(get_the_date('c', $post_id)); ?>">
                    <?php echo esc_html(get_the_date('', $post_id)); ?>
                </time>
            </div>
        <?php endif; ?>
        
        <?php if ($show_excerpt) : ?>
            <div class="post-excerpt">
                <?php echo wp_trim_words(get_the_excerpt($post_id), 20, '...'); ?>
            </div>
        <?php endif; ?>
        
        <a href="<?php echo esc_url(get_permalink($post_id)); ?>" class="btn read-more">
            <?php _e('Read More', 'balefire'); ?>
        </a>
    </div>
</article>

