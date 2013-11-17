<?php

/**
 * the query
 *
 * @package   the_query
 * @author    Thomas Maier <thomas.maier@webgilde.com>
 * @license   GPL-2.0+
 * @link      http://webgilde.com
 * @copyright 2013 Thomas Maier, webgilde GmbH
 */

/**
 * This class is used to bundle callbacks for rendering parameters for the query
 *
 * there should be a callback for every query parameter named exactly like it
 *
 * @package The_Query_Admin_Parameter_Callbacks
 * @author  Thomas Maier<thomas.maier@webgilde.com>
 */
class The_Query_Admin_Parameter_Callbacks {

    /**
     * callback for _post_type_ parameter
     *
     * @since 1.0.0
     */
    public static function post_type() {
        // get all the authors registered
        $types = get_post_types(array(), 'objects');
        // exclude post types
        // filter lets others add their post types to be excluded
        $excluded_pt = apply_filters('the_query_post_type_exclude', array(The_Query::POST_TYPE_SLUG));
        foreach( $types as $_type_key => $_type ) {
            if ( in_array($_type->name, $excluded_pt ))
                unset($types[$_type_key]);
        }
        self::render(__FUNCTION__, array('types' => $types));
    }

    /**
     * callback for _posts_per_page_ parameter
     *
     * @since 1.0.0
     */
    public static function posts_per_page() {
        // get general value
        $default_ppp = get_option('posts_per_page', 10);
        self::render(__FUNCTION__, array('default_ppp' => $default_ppp));
    }

    /**
     * callback for _orderby_ parameter
     * includes setting of _order_
     *
     * @since 1.0.0
     */
    public static function orderby( $values = '') {
        // get general value
        self::render(__FUNCTION__, array('values' => $values));
    }

    /**
     * callback for _author_ parameter
     *
     * @since 1.0.0
     */
    public static function author() {
        // get all the authors registered
        $args = array(
            'who' => 'authors'
        );
        $users = get_users( $args );
        self::render(__FUNCTION__, array('users' => $users));
    }

    /**
     * render a view to this callback
     * callbacks are placed in a subdirectory of the view directory
     *
     * @since 1.0.0
     * @param $view string name pre-attached to the callback view
     * @param $args array arguments, will be usable under the key name
     */
    private static function render($view = '', $args = 0) {
        if($view == '') return;
        $index = $view;

        $_textdomain = The_Query::get_instance()->get_plugin_slug();
        $view = THEQUERYBASEPATH . 'admin/views/callbacks/' . $view . '.php';

        // load current value
        $current = '';
        if(!empty(The_Query_Admin::get_instance()->query_args[$index]))
            $current = The_Query_Admin::get_instance()->query_args[$index];

        if (is_file($view)) {
            if(is_array($args)) extract ($args); // extract arguments to be useable in the template
            require_once( $view );
        }

    }

}