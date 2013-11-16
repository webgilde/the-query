<?php

/*
 * query parameter groups
 *
 * (key)    string  parameter group id
 * $name    string  translateable group name
 * $params  arr     parameters with ids from the_query_parameters array
 * $advanced bool   true, if advanced setting and hidden by default; false by default
 *
 */

// put textdomain in temporary variable, because it is easier to handly
$_textdomain = The_Query::get_instance()->get_plugin_slug();

$the_query_parameter_groups = array(
    'author' => array(
        'name' => __('Authors', $_textdomain),
        'params' => array(
            'author'
        ),
        'advanced' => true
    ),
    'category' => array(
        'name' => __('Categories', $_textdomain),
        'params' => array(
            'cat',
        ),
        'advanced' => true
    )
);