<?php
/**
 * the query
 *
 * UI to build and manage queries in WordPress
 *
 * @package   the_query
 * @author    Thomas Maier <thomas.maier@webgilde.com>
 * @license   GPL-2.0+
 * @link      http://webgilde.com
 * @copyright 2013 Thomas Maier, webgilde GmbH
 *
 * @wordpress-plugin
 * Plugin Name:       the query
 * Plugin URI:        http://webgilde.com
 * Description:       UI to build and manage queries in WordPress
 * Version:           1.0.0
 * Author:            Thomas Maier
 * Author URI:        http://webgilde.com
 * Text Domain:       the-query
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 *
 * based on https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate, version from Nov 16th 2013
 * inspirations from https://github.com/iandunn/WordPress-Plugin-Skeleton
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define('THEQUERYBASEPATH', plugin_dir_path(__FILE__));

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-the-query.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'The_Query', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'The_Query', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'The_Query', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-the-query-admin.php' );
	add_action( 'plugins_loaded', array( 'The_Query_Admin', 'get_instance' ) );

}
