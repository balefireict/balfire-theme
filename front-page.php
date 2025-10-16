<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;

get_header(); ?>

<?php if (have_posts()):
    while (have_posts()):
        the_post(); ?>

	<main role="main" id="main-content" class="wrapper">
		<section>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1><?php echo esc_html(get_the_title()); ?></h1>
				<?php the_content(); ?>
			</article>
		</section>
	</main>

	<?php endwhile; ?>

	<?php else: ?>
	<main>
		<section>
			<article>
				<h2>
					<?php _e('Sorry, nothing to display.', 'balefire'); ?>
				</h2>
			</article>
		</section>
	</main>
	<?php endif; ?>

<?php get_footer(); ?>
