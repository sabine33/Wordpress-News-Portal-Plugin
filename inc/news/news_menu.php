<?php
/*
* Creating a function to create our CPT
*/
abstract class NewsCPT
{
    public static function add()
    {
        // Set UI labels for Custom Post Type
        $labels = array(
            'name' => _x('News', 'Post Type General Name', 'twentythirteen'),
            'singular_name' => _x('News', 'Post Type Singular Name', 'twentythirteen'),
            'menu_name' => __('News', 'twentythirteen'),
            'parent_item_colon' => __('Parent News', 'twentythirteen'),
            'all_items' => __('All News', 'twentythirteen'),
            'view_item' => __('View News', 'twentythirteen'),
            'add_new_item' => __('Add New News', 'twentythirteen'),
            'add_new' => __('Add New', 'twentythirteen'),
            'edit_item' => __('Edit News', 'twentythirteen'),
            'update_item' => __('Update News', 'twentythirteen'),
            'search_items' => __('Search News', 'twentythirteen'),
            'not_found' => __('Not Found', 'twentythirteen'),
            'not_found_in_trash' => __('Not found in Trash', 'twentythirteen'),
        );

        // Set other options for Custom Post Type

        $args = array(
            'label' => __('News', 'twentythirteen'),
            'description' => __('Manage all News', 'twentythirteen'),
            'labels' => $labels,
            'supports' => array('title', 'custom-fields', 'thumbnail'),
            'taxonomies' => array('fullname', 'userid'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 5,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'post',
            'show_in_rest' => true,

        );
        register_post_type('news', $args);
    }
}

add_action('init', ['NewsCPT', 'add'], 0);
