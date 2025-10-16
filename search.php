<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;

get_header(); ?>

<?php get_template_part('inc/hero-header'); ?>

<main id="main-content" class="search-results-container container">
    
    <?php if (have_posts()) : ?>
        <div class="search-results-count">
            <p class="search-intro"><?php printf( __('Your search for "%s" returned %s results.', 'balefire'), 
                get_search_query(), 
                $wp_query->found_posts ); 
            ?></p>
        </div>

        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                <header class="entry-header">
                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo esc_html(get_the_title()); ?></a>
                    </h2>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="entry-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="entry-summary">
                    <?php 
                    // Get the excerpt without the automatic "Read more" link
                    $excerpt = get_the_excerpt();
                    $excerpt = preg_replace('/<a class="excerpt-read-more"[^>]*>(.*?)<\/a>/i', '', $excerpt);
                    echo $excerpt;
                    ?>
                    <a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read More', 'balefire'); ?></a>
                </div>
            </article>
        <?php endwhile; ?>

        <div class="search-pagination">
            <?php 
                echo paginate_links(array(
                    'prev_text' => '&laquo; ' . __('Previous', 'balefire'),
                    'next_text' => __('Next', 'balefire') . ' &raquo;',
                ));
            ?>
        </div>

    <?php else : ?>
        <div class="page-content search-no-results">
            <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'balefire'); ?></p>
            
            <?php get_search_form(); ?>
            
            <p><?php _e('Or you can browse our site using the navigation menu above.', 'balefire'); ?></p>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>