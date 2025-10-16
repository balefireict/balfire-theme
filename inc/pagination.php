<?php
/**
 * Pagination Template Partial
 * Simple wrapper around WordPress's built-in pagination
 */

if (!defined('ABSPATH')) exit;

// Check if pagination is needed
global $wp_query;

if ($wp_query->max_num_pages <= 1) {
    return;
}

// Use WordPress built-in pagination with custom structure
$pagination = paginate_links(array(
    'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
    'format'    => '?paged=%#%',
    'current'   => max(1, get_query_var('paged')),
    'total'     => $wp_query->max_num_pages,
    'type'      => 'array',
    'mid_size'  => 2,
    'end_size'  => 1,
    'prev_text' => __('« Previous', 'balefire'),
    'next_text' => __('Next »', 'balefire'),
));

if (!empty($pagination)) :
?>
<section class="wrapper">
    <div class="pagination">
        <?php foreach ($pagination as $page) : ?>
            <?php echo $page; ?>
        <?php endforeach; ?>
    </div>
</section>
<?php
endif;

