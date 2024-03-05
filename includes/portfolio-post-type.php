<?php
// Register Portfolio Custom Post Type
function register_portfolio_post_type() {
    $labels = array(
        'name'               => _x('Portfolio', 'post type general name'),
        'singular_name'      => _x('Portfolio', 'post type singular name'),
        'menu_name'          => _x('Portfolio', 'admin menu'),
        'add_new'            => _x('Add New', 'portfolio'),
        'add_new_item'       => __('Add New Portfolio Item'),
        'edit_item'          => __('Edit Portfolio Item'),
        'new_item'           => __('New Portfolio Item'),
        'view_item'          => __('View Portfolio Item'),
        'search_items'       => __('Search Portfolio'),
        'not_found'          => __('No portfolio items found'),
        'not_found_in_trash' => __('No portfolio items found in Trash'),
        'parent_item_colon'  => '',
        'menu_icon'          => 'dashicons-portfolio', // You can change the icon
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'portfolio'),
        'supports'           => array('title', 'editor', 'thumbnail'),
        'register_meta_box_cb' => 'add_portfolio_meta_boxes',
    );

    register_post_type('portfolio', $args);
}

add_action('init', 'register_portfolio_post_type');

// Add meta boxes for the portfolio post type
function add_portfolio_meta_boxes() {
    add_meta_box(
        'portfolio_project_link',
        'Project Link',
        'portfolio_project_link_callback',
        'portfolio',
        'normal',
        'default'
    );
}

// Callback function to display the project link meta box
function portfolio_project_link_callback($post) {
    // Get the current value of the project link
    $project_link = get_post_meta($post->ID, '_project_link', true);

    // Output the HTML for the project link input
    ?>
    <label for="project_link">Project Link:</label>
    <input type="url" id="project_link" name="project_link" value="<?php echo esc_attr($project_link); ?>" style="width: 100%;" />
    <?php
}

// Save the project link when the portfolio post is saved
function save_portfolio_project_link($post_id) {
    if (isset($_POST['project_link'])) {
        update_post_meta($post_id, '_project_link', esc_url($_POST['project_link']));
    }
}

add_action('save_post_portfolio', 'save_portfolio_project_link');
?>

