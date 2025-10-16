<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;

get_header(); ?>
<main>

	<?php get_template_part('inc/hero-header'); ?>
	
	<section class="container">

		<h1 class="page-title">
			<?php the_archive_title(); ?>
		</h1>

		<?php the_archive_description('<div class="taxonomy-description">', '</div>'); ?>
		
		<?php if (have_posts()):
            while (have_posts()):
                the_post(); ?>
			<?php get_template_part('inc/loop', 'archive'); ?>
		<?php endwhile; ?>	
		<?php else: ?>
			<?php get_template_part('inc/content', 'missing'); ?>
		<?php endif; ?>

	</section>
</main>
<?php // get_sidebar(); ?>
<?php get_footer(); ?>