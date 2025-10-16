<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;

get_header(); ?>
<main>
	<section class="container">
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