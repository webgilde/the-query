<h5><?php _e('Choose post type(s)', $_textdomain); ?></h5>
<?php if (empty($types)) : ?><p><?php _e('No post types found', $_textdomain); ?></p>
<?php else : ?>
    <?php foreach ($types as $_type) : ?>
        <input type="checkbox" id="the_query_post_type_<?php echo $_type->name; ?>" name="the_query[post_type][]"
               value="<?php echo $_type->name; ?>" <?php if($current == $_type->name || in_array($_type->name, $current)) : ?>checked="checked"<?php endif; ?>/>
        <label for="the_query_post_type_<?php echo $_type->name; ?>"><?php echo $_type->label; ?></label>
    <?php endforeach; ?>
<?php endif; ?>