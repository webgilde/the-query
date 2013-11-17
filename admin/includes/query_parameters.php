<?php

/*
 * query parameters, their default values and settings
 *
 * meaning of the fields
 *
 * (key)    string  parameter as how it is used by WP_Query
 * $name    string  translateable name of the parameter
 * $type    string  type, needed for validation; possible: int, string, array-int (array with integers), mixed
 * $default string  default value, if none was given
 * $advanced bool   true, if advanced setting and hidden by default; false by default
 */

// put textdomain in temporary variable, because it is easier to handly
$_textdomain = The_Query::get_instance()->get_plugin_slug();

$the_query_parameters = array(
    'author' => array(
        'name' => __('Author', $_textdomain),
        'type' => 'array-int',
    ),
    'cat' => array( // include and exclude from categories with child categories
        'name' => __('Categories', $_textdomain),
        'type' => 'array-int',
    ),
    'category__in' => array( // include from categories without child categories
        'name' => __('Include Categories except children', $_textdomain),
        'type' => 'array-int',
    ),
    'category__not_in' => array( // exclude categories, but not their child categories
        'name' => __('Exclude Categories, but not children', $_textdomain),
        'type' => 'array-int',
    ),
    'category__and' => array(
        'name' => __('Category Combinations', $_textdomain),
        'type' => 'array-int',
    ),
    'post_type' => array(
        'name' => __('Post Type', $_textdomain),
        'type' => 'array-int',
        'default' => 'post'
    ),
    'posts_per_page' => array(
        'name' => __('Number', $_textdomain),
        'type' => 'string',
        'default' => 'default'
    ),
    'orderby' => array(
        'name' => __('Sortierung', $_textdomain),
        'type' => 'string',
        'values' => array(
            'none'      => __('none', $_textdomain),
            'ID'        => __('ID of entities', $_textdomain),
            'author'    => __('Author', $_textdomain),
            'title'     => __('Title', $_textdomain),
            'name'      => __('URL slug (name)', $_textdomain),
            'date'      => __('Date', $_textdomain),
            'modified'  => __('Date when last modified', $_textdomain),
            'date'      => __('Date', $_textdomain),
            'parent'    => __('Parent ID', $_textdomain),
            'comment_count' => __('Number of comments', $_textdomain),
            'menu_order' => __('Menu order', $_textdomain),
        ),
        'default' => 'date'
    ),
);