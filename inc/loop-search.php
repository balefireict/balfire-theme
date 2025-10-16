<?php if (have_posts()):
    while (have_posts()):
        the_post(); ?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<!-- post thumbnail -->
		<?php if (has_post_thumbnail()): ?>
			<div class="post-thumb">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail('gallery-thumb'); ?>
				</a>
			</div>
		<?php else: ?>
			<div class="post-thumb">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/img/no-image.png" alt="<?php the_title(); ?>">
				</a>
			</div>
		<?php endif; ?>
		<!-- /post thumbnail -->

		<div class="post-info">
			<!-- post title -->
			<h2>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			<!-- /post title -->

			<?php the_excerpt(); ?>
		</div>

	</article>
	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2 class="text-center"><?php _e('Sorry, nothing to display.', 'html5blank'); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
