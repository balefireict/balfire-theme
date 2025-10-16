<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;

/** The template part for displaying an author byline */
?>
<p class="byline">
	<?php
    printf(
        __('Posted on %1$s by %2$s - %3$s', 'balefirewp'),
        get_the_time(__('F j, Y', 'balefirewp')),
        get_the_author_posts_link(),
        get_the_category_list(', ')
    );
    ?>
</p>