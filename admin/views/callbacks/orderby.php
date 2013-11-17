<h4><?php _e('How to sort them?', $_textdomain); ?></h4>
<div class="inner">
<?php if(is_array($values)) : ?>
<select name="the_query[orderby]">
<?php foreach($values as $_value_key => $_value ) : ?>
    <option value="<?php echo $_value_key; ?>" <?php selected($current, $_value_key); ?>><?php echo $_value; ?></option>
<?php endforeach; ?>
</select>
<input type="checkbox" id="the_query_order"
    name="the_query[order]" value=""/>
<label for="the_query_order"><?php _e('revert order (use ASC)', $_textdomain); ?></label>
<?php endif; ?>
<p><?php _e('OR', $_textdomain); ?></p>
<input type="checkbox" id="the_query_orderby_random"
       name="the_query[orderby]" value="random" <?php checked($current, 'random'); ?>/>
<label for="the_query_orderby_random"><?php _e('random order', $_textdomain); ?></label>
</div>