<?php

/**
 * The template for displaying search forms
 *
 * @package Balefire
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr_x('Site Search', 'accessibility label', 'balefire'); ?>">
	<div class="search-form-group">
		<label for="search-field" class="search-label">
			<span class="sr-only"><?php echo _x('Search for:', 'label', 'balefire'); ?></span>
		</label>
		<input type="search" 
			   id="search-field" 
			   class="search-field" 
			   placeholder="<?php echo esc_attr_x('Search...', 'balefire'); ?>" 
			   value="<?php echo get_search_query(); ?>" 
			   name="s" 
			   aria-required="true"
			   aria-label="<?php echo esc_attr_x('Search', 'input field aria label', 'balefire'); ?>" />
		<button type="submit" class="search-submit button" aria-label="<?php echo esc_attr_x('Submit Search', 'submit button aria label', 'balefire'); ?>">
			<?php echo esc_html_x('Search', 'submit button', 'balefire'); ?>
		</button>
	</div>
</form> 