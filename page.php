<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<main>

		<section id="content" class="wrapper">
			<h1 class="page-title h1">
				<?php the_title(); ?>
			</h1>

			<?php the_content(); ?>
		
		</section>
		
	</main>

<?php endwhile; endif; ?>	

<?php get_footer(); ?>