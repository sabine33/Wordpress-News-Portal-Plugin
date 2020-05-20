<?php

abstract class StyleWP
{

    public static function am_enqueue_admin_styles()
    {
        wp_register_style('am_admin_bootstrap', plugins_url('/assets/css/bootstrap_iso.min.css', __FILE__));
        wp_enqueue_style('am_admin_bootstrap');
    }
}

add_action('admin_enqueue_scripts', ['StyleWP', 'am_enqueue_admin_styles']);
