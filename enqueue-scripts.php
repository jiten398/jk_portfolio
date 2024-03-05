<?php
function enqueue_portfolio_scripts() {
    // Enqueue your styles and scripts here
    wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), '4.3.1');

    // Enqueue your custom styles
    wp_enqueue_style('portfolio-styles', plugin_dir_url(__FILE__) . 'styles/template.css');

    // Enqueue Bootstrap JS and Popper.js (required for Bootstrap)
    wp_enqueue_script('portfolio-script', plugin_dir_url(__FILE__) . 'js/iframe.js', array(), null, true);
    wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), '1.14.7', true);
    wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('popper'), '4.3.1', true);
}

add_action('wp_enqueue_scripts', 'enqueue_portfolio_scripts');
