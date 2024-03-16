<?php
/*
Plugin Name: jk Portfolio lite 
Description: Transform your WordPress website into a dynamic showcase with the jk Portfolio Plugin. Easily create and display stunning portfolios. Impress your visitors with a professional and visually appealing portfolio presentation.
Version: 1.1
Author: Jitendra saraf
Author URI: https://jitendrasaraf.in/
Tags: portfolio showcase, portfolio, showcase, portfolio with iframe, jk portfolio
Requires at least: 3.1
Tested up to: 6.4.3
Stable tag: 1.1
License: GPLv2 or later
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Register custom post type
require_once plugin_dir_path(__FILE__) . 'includes/portfolio-post-type.php';

// Enqueue styles and scripts
require_once plugin_dir_path(__FILE__) . 'enqueue-scripts.php';

// Display portfolio on custom page
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';
