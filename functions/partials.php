<?php
/**
 * Partials System
 * Reusable template parts for consistent layouts across archives, search, etc.
 */

if (!defined('ABSPATH')) exit;

/**
 * Get a partial template with data
 * 
 * @param string $slug The partial slug (e.g., 'card', 'list-item')
 * @param array $data Data to pass to the partial
 * @param string $name Optional. Specific partial name (e.g., 'card-large')
 * @return void
 */
function balefire_partial($slug, $data = array(), $name = null)
{
    // Make data available to the template
    set_query_var('partial_data', $data);
    
    // Look in inc/partials/ directory
    $templates = array();
    
    if ($name) {
        $templates[] = "inc/partials/{$slug}-{$name}.php";
    }
    
    $templates[] = "inc/partials/{$slug}.php";
    
    locate_template($templates, true, false);
    
    // Clean up
    set_query_var('partial_data', null);
}

/**
 * Get partial template (returns string instead of echoing)
 * 
 * @param string $slug The partial slug
 * @param array $data Data to pass to the partial
 * @param string $name Optional. Specific partial name
 * @return string
 */
function balefire_get_partial($slug, $data = array(), $name = null)
{
    ob_start();
    balefire_partial($slug, $data, $name);
    return ob_get_clean();
}

/**
 * Display archive header with title and description
 * 
 * @param array $args Optional arguments
 * @return void
 */
function balefire_archive_header($args = array())
{
    if (!is_archive() && !is_search() && !is_home()) {
        return;
    }
    
    $defaults = array(
        'show_description' => true,
        'show_count' => true,
        'show_breadcrumbs' => false,
        'class' => 'archive-header',
    );
    
    $args = wp_parse_args($args, $defaults);
    
    ?>
    <header class="<?php echo esc_attr($args['class']); ?>">
        <?php
        if ($args['show_breadcrumbs'] && function_exists('balefire_breadcrumbs')) {
            balefire_breadcrumbs();
        }
        
        the_archive_title('<h1 class="archive-title">', '</h1>');
        
        if ($args['show_description']) {
            the_archive_description('<div class="archive-description">', '</div>');
        }
        
        if ($args['show_count']) {
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
        }
        ?>
    </header>
    <?php
}

/**
 * Display post card (for grids, archives)
 * 
 * @param int|WP_Post $post Optional post ID or object
 * @param array $args Optional arguments
 * @return void
 */
function balefire_post_card($post = null, $args = array())
{
    $post = get_post($post);
    
    if (!$post) {
        return;
    }
    
    $defaults = array(
        'show_thumbnail' => true,
        'show_excerpt' => true,
        'show_meta' => true,
        'show_author' => true,
        'show_date' => true,
        'show_categories' => true,
        'excerpt_length' => 20,
        'thumbnail_size' => 'medium',
        'class' => 'post-card',
        'heading_tag' => 'h2',
    );
    
    $args = wp_parse_args($args, $defaults);
    
    ?>
    <article id="post-<?php echo esc_attr($post->ID); ?>" <?php post_class($args['class']); ?>>
        <?php if ($args['show_thumbnail'] && has_post_thumbnail($post)) : ?>
            <div class="post-thumbnail">
                <a href="<?php echo esc_url(get_permalink($post)); ?>" aria-hidden="true" tabindex="-1">
                    <?php echo get_the_post_thumbnail($post, $args['thumbnail_size']); ?>
                </a>
            </div>
        <?php endif; ?>
        
        <div class="post-content">
            <?php if ($args['show_categories']) : ?>
                <div class="post-categories">
                    <?php
                    $categories = get_the_category($post);
                    if ($categories) {
                        echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
                    }
                    ?>
                </div>
            <?php endif; ?>
            
            <<?php echo esc_attr($args['heading_tag']); ?> class="post-title">
                <a href="<?php echo esc_url(get_permalink($post)); ?>">
                    <?php echo esc_html(get_the_title($post)); ?>
                </a>
            </<?php echo esc_attr($args['heading_tag']); ?>>
            
            <?php if ($args['show_meta']) : ?>
                <div class="post-meta">
                    <?php if ($args['show_author']) : ?>
                        <span class="post-author">
                            By <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID', $post->post_author))); ?>">
                                <?php echo esc_html(get_the_author_meta('display_name', $post->post_author)); ?>
                            </a>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ($args['show_date']) : ?>
                        <time class="post-date" datetime="<?php echo esc_attr(get_the_date('c', $post)); ?>">
                            <?php echo esc_html(get_the_date('', $post)); ?>
                        </time>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($args['show_excerpt']) : ?>
                <div class="post-excerpt">
                    <?php echo wp_trim_words(get_the_excerpt($post), $args['excerpt_length'], '...'); ?>
                </div>
            <?php endif; ?>
            
            <a href="<?php echo esc_url(get_permalink($post)); ?>" class="btn read-more">
                <?php _e('Read More', 'balefire'); ?>
            </a>
        </div>
    </article>
    <?php
}

/**
 * Display post list item (for list layouts)
 * 
 * @param int|WP_Post $post Optional post ID or object
 * @param array $args Optional arguments
 * @return void
 */
function balefire_post_list_item($post = null, $args = array())
{
    $post = get_post($post);
    
    if (!$post) {
        return;
    }
    
    $defaults = array(
        'show_thumbnail' => true,
        'show_excerpt' => true,
        'show_meta' => true,
        'excerpt_length' => 30,
        'thumbnail_size' => 'thumbnail',
        'class' => 'post-list-item',
    );
    
    $args = wp_parse_args($args, $defaults);
    
    ?>
    <article id="post-<?php echo esc_attr($post->ID); ?>" <?php post_class($args['class']); ?>>
        <?php if ($args['show_thumbnail'] && has_post_thumbnail($post)) : ?>
            <div class="post-thumbnail">
                <a href="<?php echo esc_url(get_permalink($post)); ?>">
                    <?php echo get_the_post_thumbnail($post, $args['thumbnail_size']); ?>
                </a>
            </div>
        <?php endif; ?>
        
        <div class="post-content">
            <h3 class="post-title">
                <a href="<?php echo esc_url(get_permalink($post)); ?>">
                    <?php echo esc_html(get_the_title($post)); ?>
                </a>
            </h3>
            
            <?php if ($args['show_meta']) : ?>
                <div class="post-meta">
                    <time datetime="<?php echo esc_attr(get_the_date('c', $post)); ?>">
                        <?php echo esc_html(get_the_date('', $post)); ?>
                    </time>
                </div>
            <?php endif; ?>
            
            <?php if ($args['show_excerpt']) : ?>
                <div class="post-excerpt">
                    <?php echo wp_trim_words(get_the_excerpt($post), $args['excerpt_length'], '...'); ?>
                </div>
            <?php endif; ?>
        </div>
    </article>
    <?php
}

/**
 * Display no results message
 * 
 * @param array $args Optional arguments
 * @return void
 */
function balefire_no_results($args = array())
{
    $defaults = array(
        'title' => __('Nothing Found', 'balefire'),
        'message' => __('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'balefire'),
        'show_search' => true,
        'class' => 'no-results',
    );
    
    $args = wp_parse_args($args, $defaults);
    
    ?>
    <div class="<?php echo esc_attr($args['class']); ?>">
        <h2><?php echo esc_html($args['title']); ?></h2>
        <p><?php echo esc_html($args['message']); ?></p>
        
        <?php if ($args['show_search']) : ?>
            <div class="search-form-wrapper">
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Display loading spinner
 * 
 * @param string $class Additional classes
 * @return void
 */
function balefire_loading_spinner($class = '')
{
    ?>
    <div class="loading-spinner <?php echo esc_attr($class); ?>" role="status" aria-live="polite">
        <span class="sr-only"><?php _e('Loading...', 'balefire'); ?></span>
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 50 50">
            <circle cx="25" cy="25" r="20" fill="none" stroke="currentColor" stroke-width="4" stroke-dasharray="31.4 31.4" stroke-linecap="round">
                <animateTransform attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="1s" repeatCount="indefinite"/>
            </circle>
        </svg>
    </div>
    <?php
}

