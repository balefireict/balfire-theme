<form class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>" role="search">
    <label for="search-input" class="sr-only"><?php _e('Search', 'balefire'); ?></label>
    <div class="search-wrapper">
        <div class="search-icon">
            <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input id="search-input" class="search-input" type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr_x('To search, type and hit enter.', 'placeholder', 'balefire'); ?>" required>
        <button class="search-submit" type="submit" role="button"><?php _e('Search', 'balefire'); ?></button>
    </div>
</form>
