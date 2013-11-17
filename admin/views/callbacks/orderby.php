<h5><?php _e('How to sort them?', $_textdomain); ?></h5>
<?php if(is_array($values)) : ?>
<select name="the_query[orderby]">
<?php foreach($values as $_value_key => $_value ) : ?>
    <option value="<?php echo $_value_key; ?>"><?php echo $_value; ?></option>
<?php endforeach; ?>
</select>
<?php endif; ?>
<?php _e('OR', $_textdomain); ?><input type="checkbox" id="the_query_orderby_random"
       name="the_query[order]" value="random"/>
<label for="the_query_orderby_random"><?php _e('random order', $_textdomain); ?></label>
<p>
    <input type="checkbox" id="the_query_order"
       name="the_query[order]" value=""/>
    <label for="the_query_order"><?php _e('revert order (use ASC)', $_textdomain); ?></label>
</p>