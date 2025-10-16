<?php
declare(strict_types=1);

if (!defined('ABSPATH')) exit;
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="search-field" class="sr-only"><?php _e('Search for:', 'balefire'); ?></label>
    <input type="search" id="search-field" class="search-field" placeholder="<?php esc_attr_e('Search...', 'balefire'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" />
    <button type="submit" class="search-submit">
        <span class="sr-only"><?php _e('Search', 'balefire'); ?></span>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" fill="white"/>
        </svg>
    </button>
</form> 