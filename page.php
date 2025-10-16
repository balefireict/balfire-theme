<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<main>
		<?php get_template_part('inc/page-heading'); ?>
		
		<section id="content" class="wrapper">

			<?php the_content(); ?>
		
		</section>
		
	</main>

<?php endwhile; endif; ?>	

<?php get_footer(); ?>