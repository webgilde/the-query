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
 * This class is used to work with the administrative side of the WordPress site.
 *
 * @package The_Query_Admin
 * @author  Thomas Maier <thomas.maier@webgilde.com>
 */
class The_Query_Admin {

    /**
     * Array with parameters for the query
     *
     * @since 1.0.0
     *
     * @var array
     */
    public $params = array();

    /**
     * Array with groups of parameters for the query
     *
     * @since 1.0.0
     *
     * @var array
     */
    public $param_groups = array();

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;

    /**
     * Slug of the plugin screen.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $plugin_screen_hook_suffix = null;

    /**
     * Initialize the plugin by loading admin scripts & styles and adding a
     * settings page and menu.
     *
     * @since     1.0.0
     */
    private function __construct() {

        /*
         * Call $plugin_slug from public plugin class.
         *
         */
        $plugin = The_Query::get_instance();
        $this->plugin_slug = $plugin->get_plugin_slug();

        // Load admin style sheet and JavaScript.
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));

        // Add the options page and menu item.
        add_action('admin_menu', array($this, 'add_plugin_admin_menu'));

        // Add an action link pointing to the options page.
        $plugin_basename = plugin_basename(plugin_dir_path(__DIR__) . $this->plugin_slug . '.php');
        add_filter('plugin_action_links_' . $plugin_basename, array($this, 'add_action_links'));

        add_action('admin_init', array($this, 'add_meta_boxes'));
        add_action('admin_init', array($this, 'load_query_arrays'));
    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Register and enqueue admin-specific style sheets.
     *
     * @since     1.0.0
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_styles() {

        if (!isset($this->plugin_screen_hook_suffix)) {
            return;
        }

        $screen = get_current_screen();
        if ($this->plugin_screen_hook_suffix == $screen->id || 'the_queries' == $screen->id ) {
            wp_enqueue_style($this->plugin_slug . '-admin-styles', plugins_url('assets/css/admin.css', __FILE__), array(), The_Query::VERSION);
        }
    }

    /**
     * Register and enqueue admin-specific JavaScript.
     *
     * @since     1.0.0
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_scripts() {

        if (!isset($this->plugin_screen_hook_suffix)) {
            return;
        }

        $screen = get_current_screen();
        if ($this->plugin_screen_hook_suffix == $screen->id) {
            wp_enqueue_script($this->plugin_slug . '-admin-script', plugins_url('assets/js/admin.js', __FILE__), array('jquery'), The_Query::VERSION);
        }
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */
    public function add_plugin_admin_menu() {

        /*
         * Add a settings page for this plugin to the Settings menu.
         */
        $this->plugin_screen_hook_suffix = add_options_page(
                __('The_Query settings', $this->plugin_slug), __('The_Query', $this->plugin_slug), 'manage_options', $this->plugin_slug, array($this, 'display_plugin_admin_page')
        );
    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_admin_page() {
        include_once( 'views/admin.php' );
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */
    public function add_action_links($links) {

        return array_merge(
                        array(
                    'settings' => '<a href="' . admin_url('options-general.php?page=' . $this->plugin_slug) . '">' . __('Settings', $this->plugin_slug) . '</a>'
                        ), $links
        );
    }

    /**
     * Add meta boxes for the query post type
     *
     * @since    1.0.0
     */
    public function add_meta_boxes() {
        add_meta_box(
                'query-parameters-box', __('Query Parameters (define which content to get)', $this->plugin_slug), array($this, 'markup_meta_boxes'), The_Query::POST_TYPE_SLUG, 'normal', 'high'
        );
    }

    /**
     * load arrays we need to build the query
     */
    public function load_query_arrays() {
        require_once(plugin_dir_path(__FILE__) . 'includes/query_parameter_groups.php');
        require_once(plugin_dir_path(__FILE__) . 'includes/query_parameters.php');
        $this->params = $the_query_parameters;
        $this->param_groups = $the_query_parameter_groups;
    }

    /**
     * load templates for all meta boxes
     *
     * @since 1.0.0
     * @param obj $post
     * @param array $box
     */
    public function markup_meta_boxes($post, $box) {
        switch ($box['id']) {
            case 'query-parameters-box':
                $parameter_contents = $this->load_parameter_group_meta_boxes($post);
                $view = 'parameters-metabox.php';
                break;
        }

        $view = plugin_dir_path(__FILE__) . 'views/' . $view;
        if (is_file($view)) {
            require_once( $view );
        }
    }

    /**
     * load meta boxes for parameters ordered by groups
     *
     * @since 1.0.0
     * @param obj $post
     * @param string $parameter
     */
    public function load_parameter_group_meta_boxes($post) {
        require_once(plugin_dir_path(__FILE__) . 'includes/class-parameter-callbacks.php');
        if(isset($this->param_groups) && isset($this->params) && class_exists('The_Query_Admin_Parameter_Callbacks'))
        foreach($this->param_groups as $_parameter_group_id => $_parameter_group) {
            // get content for the parameters
            if(is_array($_parameter_group['params']))
            foreach($_parameter_group['params'] as $_parameter_id) {
                ob_start();
                    // check, if parameter callback function exists
                    if(method_exists('The_Query_Admin_Parameter_Callbacks', $_parameter_id)) {
                        The_Query_Admin_Parameter_Callbacks::$_parameter_id();
                    }
                    // get parameter callback function

                $this->param_groups[$_parameter_group_id]['param_content'][$_parameter_id] = ob_get_clean();
            }
        }
    }

}
