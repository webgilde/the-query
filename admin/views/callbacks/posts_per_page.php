<h4><?php _e('How many?', $_textdomain); ?></h4>
<div class="inner">
<input type="radio" id="the_query_posts_per_page"
       name="the_query[posts_per_page]" value=""
       <?php if(absint($current)) : ?> checked="checked"<?php endif; ?>/>
<label for="the_query_posts_per_page"><?php _e('enter own number', $_textdomain); ?></label>
<input type="number" name="the_query[posts_per_page]" value="<?php if(absint($current)) echo $current; ?>"/>
<p class="or"><?php _e('OR', $_textdomain); ?></p>
<input type="radio" id="the_query_posts_per_page_default"
       name="the_query[posts_per_page]" value="default"
       <?php checked($current, 'default'); ?>/>
<label for="the_query_posts_per_page_default"><?php printf(__('use default, currently <strong>%d</strong>', $_textdomain), $default_ppp); ?></label>
<p class="or"><?php _e('OR', $_textdomain); ?></p>
<input type="radio" id="the_query_posts_per_page_all"
       name="the_query[posts_per_page]" value="-1"
       <?php checked($current, -1); ?>/>
<label for="the_query_posts_per_page_all"><?php _e('unlimited', $_textdomain); ?></label>
</div>