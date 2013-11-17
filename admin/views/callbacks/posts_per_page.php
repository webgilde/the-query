<h5><?php _e('How many do you want to show?', $_textdomain); ?></h5>
<input type="radio" id="the_query_posts_per_page"
       name="the_query[posts_per_page]" value=""/>
<label for="the_query_posts_per_page"><?php _e('enter own number', $_textdomain); ?></label>
<input type="number" name="the_query[posts_per_page]"/>
<?php _e('OR', $_textdomain); ?>
<input type="radio" id="the_query_posts_per_page_default"
       name="the_query[posts_per_page]" value="default"/>
<label for="the_query_posts_per_page_default"><?php printf(__('use default, currently <strong>%d</strong> (see <em>Settings > Read</em>)', $_textdomain), $default_ppp); ?></label>
<?php _e('OR', $_textdomain); ?>
<input type="radio" id="the_query_posts_per_page_all"
       name="the_query[posts_per_page]" value="-1"/>
<label for="the_query_posts_per_page_all"><?php _e('unlimited', $_textdomain); ?></label>