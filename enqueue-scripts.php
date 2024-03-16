<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function jk_enqueue_portfolio_scripts() {
    // Enqueue your styles and scripts here
    wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . 'styles/bootstrap.min.css', array(), '4.3.1');

    // Enqueue Bootstrap JS and Popper.js (required for Bootstrap)
    wp_enqueue_script('portfolio-script', plugin_dir_url(__FILE__) . 'js/iframe.js', array(), null, true);
    wp_enqueue_script('popper', plugin_dir_url(__FILE__) . 'js/popper.min.js', array('jquery'), '1.14.7', true);
    wp_enqueue_script('bootstrap', plugin_dir_url(__FILE__) . 'js/bootstrap.min.js', array('popper'), '4.3.1', true);
}

add_action('wp_enqueue_scripts', 'jk_enqueue_portfolio_scripts');
