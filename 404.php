<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;

/**
 * The template for displaying 404 pages (not found)
 *
 * @package Balefire
 */
get_header();
?>

<?php get_template_part('inc/hero-header'); ?>

	<main id="container-404"class="container" role="main">
		<article class="content-not-found">

			<section>
				<p>
					<?php _e('The page you were looking for was not found. Please try one of the following:', 'balefire'); ?>
				</p>
				<ul class="no-bullet">
					<li>
						<?php _e('Check your spelling', 'balefire'); ?>
					</li>
					<li>
						<?php _e('Return to the', 'balefire'); ?><a href="<?php echo home_url(); ?>"><?php _e('home page', 'balefire'); ?></a>
					</li>
					<li>
						<?php _e('Click the', 'balefire'); ?> <a href="javascript:history.back()"><?php _e('back button', 'balefire'); ?></a>
					</li>
				</ul>
			</section>

			<section class="search">
				<p><?php _e('You can also try searching:', 'balefire'); ?></p>
				<?php get_template_part('inc/search-form'); ?>
			</section>
			
		</article>
	</main>

<?php get_footer(); ?>