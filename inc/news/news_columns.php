<?php

abstract class NewsColumns
{


    public static function map($columns)
    {
        $columns['image'] = __('Image');
        $columns['author'] = __('Author', 'author');
        // $columns['description'] = __('Description', 'description');
        $columns['area'] = __('Area', 'smashing');
        return $columns;
    }


    public static  function display($column, $post_id)
    {
        // Image column
        if ($column == 'image') {
            echo get_the_post_thumbnail($post_id, array(80, 80));
        }
        if ($column == 'area') {
            echo get_post_meta($post_id, '_area', true);
        }
        if ($column == 'author') {
            echo get_post_meta($post_id, '_author', true);
        }
        // if ($column == 'description') {
        //     echo get_post_meta($post_id, '_description', true);
        // }

        // Monthly price column
        // if ('price' === $column) {
        //     $price = get_post_meta($post_id, 'price_per_month', true);

        //     if (!$price) {
        //         _e('n/a');
        //     } else {
        //         echo '$ ' . number_format($price, 0, '.', ',') . ' p/m';
        //     }
        // }
    }
}


add_filter('manage_news_posts_columns', ['NewsColumns', 'map']);
add_action('manage_news_posts_custom_column', ['NewsColumns', 'display'], 10, 2);
