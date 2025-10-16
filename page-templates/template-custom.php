<?php
declare(strict_types=1);

/*
Template Name: Custom Template
*/

get_header();
?>

<div class="container">
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <?php 
                $title = get_the_title() ?? '';
                $thumbnail_id = get_post_thumbnail_id() ?: null;
                $content_classes = ['content'];
            ?>
            
            <article class="entry-content">
                <header>
                    <h1 class="entry-title">
                        <?php echo esc_html($title); ?>
                    </h1>
                </header>

                <?php if ($thumbnail_id): ?>
                    <figure class="entry-thumbnail">
                        <?php 
                        echo wp_get_attachment_image(
                            $thumbnail_id,
                            'large',
                            false,
                            [
                                'class' => 'img-home img-responsive',
                                'loading' => 'lazy',
                                'alt' => esc_attr($title)
                            ]
                        ); 
                        ?>
                    </figure>
                <?php endif; ?>
                
                <div class="<?php echo esc_attr(implode(' ', $content_classes)); ?>">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php
get_footer();
