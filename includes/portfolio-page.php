<?php
// Create the custom page to display the portfolio
function create_portfolio_page() {
    $portfolio_page = get_page_by_path('portfolio');

    if (!$portfolio_page) {
        $portfolio_page_id = wp_insert_post(array(
            'post_title' => 'Portfolio',
            'post_type' => 'page',
            'post_status' => 'publish',
        ));

        update_option('page_on_front', $portfolio_page_id);
        update_option('show_on_front', 'page');
    }
}

add_action('init', 'create_portfolio_page');

// Customize the portfolio page template
function customize_portfolio_page_template($template) {
    if (is_page('portfolio')) {
        $new_template = plugin_dir_path(__FILE__) . 'templates/portfolio-template.php';

        if (file_exists($new_template)) {
            return $new_template;
        }
    }

    return $template;
}

add_filter('page_template', 'customize_portfolio_page_template');
