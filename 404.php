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

	<main id="container-404" role="main">
		<article id="post-404">

			<?php get_template_part('inc/page-heading', '404'); ?>

			<div class="wrapper search-page-content">
				
				<p class="center-text">
					<?php _e('We couldn\'t find the information you\'re looking for. Search our website or click a link below.', 'balefire'); ?>
				</p>
			</div>
			
			<div class="search-bar">
			<div class="wrapper">
				<?php get_template_part('inc/search-form'); ?>
			</div>
		</div>
		
		<div class="wrapper">
			<ul id="search-page-nav-links" class="no-bullets">
				<li>
					<a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home Page', 'balefire'); ?></a>
				</li>
				<li>
					•
				</li>
				<li>
					<a href="<?php echo esc_url(home_url('/contact-us/')); ?>"><?php _e('Contact Us', 'balefire'); ?></a>
				</li>
				<li>
					•
				</li>
				<li>
					<a href="<?php echo esc_url(home_url('/sitemap/')); ?>"><?php _e('Sitemap', 'balefire'); ?></a>
				</li>
			</ul>
		</div>

		</article>
	</main>

<?php get_footer(); ?>