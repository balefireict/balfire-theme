<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;
?>
        </main>
			<footer id="footer">
				<div class="wrapper">

					<div class="footer-content">					
						<a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
							<?php get_template_part('inc/logo'); ?>						
						</a>
					</div>				
				</div><!-- wrapper -->
				<div id="footer-meta">
					<div class="wrapper">
						&copy;<?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
						<a href="https://balefireagency.com" target="_blank" title="Web design by VMG" rel="noopener noreferrer">Web Design by Balefire</a>
					</div>
				</div>
			</footer>
		</div> <!-- end #page -->

		<?php wp_footer(); ?>

		<?php get_template_part('inc/footer-cookie-links'); ?>
		<?php get_template_part('inc/footer-edit-links'); ?>

	</body>
</html>