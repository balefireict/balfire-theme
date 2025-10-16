<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;

get_header(); ?>
<main>
	
	<?php get_template_part('inc/hero-header'); ?>

	<div class="container">
		<?php if (have_posts()): while (have_posts()): the_post(); ?>
			<section>
				<?php get_template_part('inc/loop', 'single'); ?>
			</section>
		<?php endwhile; else: ?>
			<section>
				<?php get_template_part('inc/content', 'missing'); ?>
			</section>
		<?php endif; ?>
	</div>
	<?php // get_template_part( 'inc/content', 'comments' ); ?>
	<?php // get_sidebar(); ?>
</main>
<?php get_footer(); ?>