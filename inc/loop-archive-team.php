<?php
/**
 * Template part for displaying posts
 *
 * Used for single, index, archive, search.
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">					
	<div class="entry-content" itemprop="text">
		<div class="medium-square">
			<a href="<?php the_permalink() ?>">
			<?php 
			if (has_post_thumbnail()) {
				// Fallback to featured image
				$thumbnail_id = get_post_thumbnail_id();
				$thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
				$thumbnail_title = get_the_title($thumbnail_id);
				
				the_post_thumbnail('full', array(
					'title' => $thumbnail_title,
					'alt' => $thumbnail_alt ? $thumbnail_alt : get_the_title()
				));
			} else {
				// Final fallback to default image
				echo '<img src="' . get_template_directory_uri() . '/assets/img/p4g-default-fallback.svg" alt="' . get_the_title() . '" title="' . get_the_title() . '" />';
			}
			?>
			</a>
		</div>
		<h2 class="team-title">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
	</div>		
    <p class="tags"><?php the_tags('<span class="tags-title">' . __('Tags:', 'balefirewp') . '</span> ', ', ', ''); ?></p>	
</article>




