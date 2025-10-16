<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;

/**
 * The sidebar containing the main widget area
 */
 ?>
<div id="sidebar1" class="sidebar" role="complementary">
	<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar1' ); ?>
	<?php endif; ?>
</div>