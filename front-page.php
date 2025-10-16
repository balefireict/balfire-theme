<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;

get_header(); ?>

<?php if (have_posts()):
    while (have_posts()):
        the_post(); ?>

	<main role="main" id="main-content">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php get_template_part('inc/page-heading'); ?>
			<div class="wrapper">
				<?php the_content(); ?>
			</div>
		</article>
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
