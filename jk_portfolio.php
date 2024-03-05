<?php
/*
Plugin Name: jk Portfolio lite 
Description: Transform your WordPress website into a dynamic showcase with the jk Portfolio Plugin. Easily create and display stunning portfolios. Impress your visitors with a professional and visually appealing portfolio presentation.
Version: 1.1
Author: Jitendra saraf
Author URI: https://jitendrasaraf.in/
*/
// Register custom post type
require_once plugin_dir_path(__FILE__) . 'includes/portfolio-post-type.php';

// Enqueue styles and scripts
require_once plugin_dir_path(__FILE__) . 'enqueue-scripts.php';

// Display portfolio on custom page
require_once plugin_dir_path(__FILE__) . 'includes/portfolio-page.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';
