<?php
/**
 * Pagination Functions
 * Enhanced pagination system for archives, search results, and custom queries
 */

if (!defined('ABSPATH')) exit;

/**
 * Enhanced numbered pagination with modern styling
 * 
 * @param WP_Query|null $query Optional custom query object
 * @param array $args Optional arguments to customize pagination
 * @return void
 */
function balefire_pagination($query = null, $args = array())
{
    global $wp_query;
    
    // Use custom query if provided, otherwise use global
    $query = $query ? $query : $wp_query;
    
    // Don't display if only one page
    if ($query->max_num_pages <= 1) {
        return;
    }
    
    // Default arguments
    $defaults = array(
        'mid_size'           => 2,
        'prev_next'          => true,
        'prev_text'          => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg> Previous',
        'next_text'          => 'Next <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>',
        'type'               => 'list',
        'current'            => max(1, get_query_var('paged')),
        'total'              => $query->max_num_pages,
        'show_all'           => false,
        'end_size'           => 1,
        'add_args'           => false,
        'add_fragment'       => '',
        'before_page_number' => '',
        'after_page_number'  => '',
        'screen_reader_text' => __('Posts navigation', 'balefire'),
        'aria_label'         => __('Posts', 'balefire'),
    );
    
    $args = wp_parse_args($args, $defaults);
    
    $big = 999999999;
    $args['base'] = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));
    
    $paginate_links = paginate_links($args);
    
    if (!$paginate_links) {
        return;
    }
    
    // Clean up the output
    $paginate_links = str_replace("<ul class='page-numbers'>", "<ul class='pagination'>", $paginate_links);
    $paginate_links = str_replace("<li><span class='page-numbers current'>", "<li class='current'><span aria-current='page'>", $paginate_links);
    $paginate_links = str_replace("<li><span class='page-numbers dots'>", "<li class='dots'><span>", $paginate_links);
    $paginate_links = preg_replace('/\s*page-numbers/', '', $paginate_links);
    
    // Output with proper accessibility
    echo '<nav class="pagination-wrapper" role="navigation" aria-label="' . esc_attr($args['aria_label']) . ' navigation">';
    echo '<h2 class="sr-only">' . esc_html($args['screen_reader_text']) . '</h2>';
    echo $paginate_links;
    echo '</nav>';
}

/**
 * Simple next/previous pagination (alternative to numbered)
 * 
 * @param array $args Optional arguments
 * @return void
 */
function balefire_posts_navigation($args = array())
{
    $defaults = array(
        'prev_text'          => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg> Previous',
        'next_text'          => 'Next <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>',
        'screen_reader_text' => __('Posts navigation', 'balefire'),
    );
    
    $args = wp_parse_args($args, $defaults);
    
    the_posts_navigation(array(
        'prev_text' => $args['prev_text'],
        'next_text' => $args['next_text'],
        'screen_reader_text' => $args['screen_reader_text'],
    ));
}

/**
 * Single post navigation (prev/next post)
 * 
 * @param array $args Optional arguments
 * @return void
 */
function balefire_post_navigation($args = array())
{
    $defaults = array(
        'prev_text' => '<span class="nav-subtitle">Previous:</span> <span class="nav-title">%title</span>',
        'next_text' => '<span class="nav-subtitle">Next:</span> <span class="nav-title">%title</span>',
        'in_same_term' => false,
        'taxonomy' => 'category',
        'screen_reader_text' => __('Post navigation', 'balefire'),
    );
    
    $args = wp_parse_args($args, $defaults);
    
    the_post_navigation(array(
        'prev_text' => $args['prev_text'],
        'next_text' => $args['next_text'],
        'in_same_term' => $args['in_same_term'],
        'taxonomy' => $args['taxonomy'],
        'screen_reader_text' => $args['screen_reader_text'],
    ));
}

/**
 * Load more button for AJAX pagination
 * 
 * @param WP_Query $query The query object
 * @param string $button_text Button text
 * @return void
 */
function balefire_load_more_button($query, $button_text = 'Load More')
{
    if ($query->max_num_pages <= 1) {
        return;
    }
    
    $current_page = max(1, get_query_var('paged'));
    
    if ($current_page >= $query->max_num_pages) {
        return;
    }
    
    ?>
    <div class="load-more-wrapper" data-max-pages="<?php echo esc_attr($query->max_num_pages); ?>" data-current-page="<?php echo esc_attr($current_page); ?>">
        <button type="button" class="btn btn-load-more" data-loading-text="Loading...">
            <?php echo esc_html($button_text); ?>
        </button>
    </div>
    <?php
}

/**
 * Get pagination info (showing X of Y posts)
 * 
 * @param WP_Query|null $query Optional custom query
 * @return string
 */
function balefire_pagination_info($query = null)
{
    global $wp_query;
    $query = $query ? $query : $wp_query;
    
    $paged = max(1, get_query_var('paged'));
    $posts_per_page = $query->get('posts_per_page');
    $total = $query->found_posts;
    
    $first = ($paged - 1) * $posts_per_page + 1;
    $last = min($total, $paged * $posts_per_page);
    
    return sprintf(
        __('Showing %s–%s of %s results', 'balefire'),
        number_format_i18n($first),
        number_format_i18n($last),
        number_format_i18n($total)
    );
}

/**
 * Display pagination info
 * 
 * @param WP_Query|null $query Optional custom query
 * @return void
 */
function balefire_display_pagination_info($query = null)
{
    echo '<div class="pagination-info">' . balefire_pagination_info($query) . '</div>';
}

