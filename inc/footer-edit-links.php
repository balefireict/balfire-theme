<?php if (is_user_logged_in() && current_user_can('administrator')): ?>
    <div class="edit-footer"><div class="wrapper"><?php edit_post_link('Edit Post', '', '', null, 'edit-post-link'); ?></div></div>
<?php endif; ?>