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

        $_textdomain = The_Query::get_instance()->plugin_name;
        $view = THEQUERYBASEPATH . 'admin/views/callbacks/' . $view . '.php';
        if (is_file($view)) {
            if(is_array($args)) extract ($args); // extract arguments to be useable in the template
            require_once( $view );
        }

    }

}