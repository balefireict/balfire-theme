<?php 
// Only show edit links on actual posts/pages, not on system templates
if (is_user_logged_in() && current_user_can('administrator') && is_singular()): 
?>
    <div class="edit-footer"><div class="wrapper"><?php edit_post_link('Edit Post', '', '', null, 'edit-post-link'); ?></div></div>
<?php endif; ?>