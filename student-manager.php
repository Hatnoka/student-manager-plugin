<?php
/*
Plugin Name: Student Manager
Description: Quan ly thong tin sinh vien.
Version: 1.0
Author: Hoàng Nam Khánh
*/

if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'includes/class-cpt.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-shortcode.php';

add_action('wp_enqueue_scripts', 'sm_enqueue_styles', 99); 
function sm_enqueue_styles() {
    wp_enqueue_style('sm-style', plugin_dir_url(__FILE__) . 'assets/style.css');
}