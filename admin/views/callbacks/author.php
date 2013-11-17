<?php if (empty($users)) : ?><p><?php _e('No authors found', $_textdomain); ?></p>
<?php else : ?>
<p class="description"><?php _e('Leave empty to get content from all authors', $_textdomain); ?></p>
    <h5><?php _e('Use content from these authors', $_textdomain); ?></h5>
    <?php foreach ($users as $_user) : ?>
        <input type="checkbox" id="the_query_author_include" name="the_query[author][]"
               value="<?php echo $_user->ID; ?>"/>
        <label for="the_query_author_include"><?php echo $_user->user_nicename; ?></label>
    <?php endforeach; ?>
    <h5><?php _e('Don’t use content from these authors', $_textdomain); ?></h5>
    <?php foreach ($users as $_user) : ?>
        <input type="checkbox" id="the_query_author_exclude" name="the_query[author_exclude][]"
               value="<?php echo $_user->ID; ?>"/>
        <label for="the_query_author_exclude"><?php echo $_user->user_nicename; ?></label>
    <?php endforeach; ?>
<?php endif; ?>