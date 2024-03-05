<?php
// Shortcode to display portfolio items with Bootstrap
function portfolio_shortcode() {
    ob_start();

    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => -1,
    );

    $portfolio_query = new WP_Query($args);

    if ($portfolio_query->have_posts()) :
        ?>
        <style>
            .item-box {
                margin-bottom: 20px; /* Adjust the spacing as needed */
                position: relative;
                overflow: hidden;
            }

            .item-box__thumb {
                position: relative;
                overflow: hidden;
            }

            .item-box__thumb img {
                transition: filter 0.3s;
                max-width: 100%; /* Ensure the image doesn't exceed its container */
            }

            .item-box__thumb:hover img {
                filter: blur(5px); /* Adjust the blur effect as needed */
            }

            .item-box__overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7);
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s;
            }

            .item-box:hover .item-box__overlay {
                opacity: 1;
            }

            .item-box__overlay-content {
                text-align: center;
                color: #fff; /* Set the font color to white or any other color you prefer */
            }

            .item-box__button {
                background-color: #fff;
                color: #000; /* Set the font color to black or any other color you prefer */
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
                transition: background-color 0.3s, color 0.3s;
                display: none; /* Initially hidden */
            }

            .item-box:hover .item-box__overlay-content .item-box__button {
                display: block; /* Show the button on hover */
            }

            .item-box__button:hover {
                background-color: #000; /* Change the background color on hover */
                color: #fff; /* Change the font color on hover */
            }
            .iframe-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                z-index: 1000;
            }

            .iframe-overlay iframe {
                width: 80%; /* Adjust the width of the iframe as needed */
                height: 80vh; /* Adjust the height of the iframe as needed */
                margin-bottom: 20px; /* Adjust the margin as needed */
            }

            .close-button {
                position: absolute;
                top: 10px;
                right: 10px;
                background-color: #fff;
                color: #000;
                padding: 10px 15px;
                border: none;
                cursor: pointer;
                font-weight: bold;
                border-radius: 5px;
                transition: background-color 0.3s, color 0.3s;
            }

            .close-button:hover {
                background-color: #000; /* Change the background color on hover */
                color: #fff; /* Change the font color on hover */
            }
            .item-box__thumb {
                position: relative;
                overflow: hidden;
                display: flex;
                align-items: flex-start; /* Align images to the top */
            }

            .item-box__thumb img {
                transition: filter 0.3s;
                width: 100%; /* Ensure the image takes full width */
            }

            .item-box__overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7);
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s;
            }

            .item-box:hover .item-box__overlay {
                opacity: 1;
            }

            .item-box__overlay-content {
                text-align: center;
                color: #fff; /* Set the font color to white or any other color you prefer */
            }

            .item-box__button {
                background-color: #fff;
                color: #000; /* Set the font color to black or any other color you prefer */
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
                transition: background-color 0.3s, color 0.3s;
                display: none; /* Initially hidden */
            }

            .item-box:hover .item-box__overlay-content .item-box__button {
                display: block; /* Show the button on hover */
            }

            .item-box__button:hover {
                background-color: #000; /* Change the background color on hover */
                color: #fff; /* Change the font color on hover */
            }
        </style>
        <section id="portfolio" class="item-area py-80">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="section-heading text-center">
                            <h2 class="section-heading__title">My Portfolio</h2>
                        </div>
                    </div>
                </div>
                <div class="row gy-4 justify-content-center">
                    <?php while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="item-box">
                                <div class="item-box__thumb">                                
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php
                                            $image_id = get_post_thumbnail_id();
                                            $image_url = wp_get_attachment_image_src($image_id, 'custom_portfolio_size', true);
                                        ?>
                                        <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid">
                                    <?php endif; ?>
                                    <div class="item-box__overlay">
                                        <div class="item-box__overlay-content">
                                            <a href="#" class="item-box__button" data-project-link="<?php echo esc_url(get_post_meta(get_the_ID(), '_project_link', true)); ?>">View Project</a>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="item-box-title"><?php the_title(); ?></h2>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
       
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var projectButtons = document.querySelectorAll('.item-box__button');
                var mainContainer = document.querySelector('.container');

                projectButtons.forEach(function (button) {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();
                        var projectLink = this.getAttribute('data-project-link');
                        if (projectLink) {
                            // Create an overlay for the iframe
                            var overlay = document.createElement('div');
                            overlay.className = 'iframe-overlay';

                            // Create a close button
                            var closeButton = document.createElement('button');
                            closeButton.className = 'close-button';
                            closeButton.textContent = 'Close';

                            // Create an iframe
                            var iframe = document.createElement('iframe');
                            iframe.src = projectLink;
                            iframe.style.width = '100%';
                            iframe.style.height = '100%';
                            iframe.style.border = 'none';                            
                            // Function to disable right-click on the iframe
                            var disableRightClick = function (e) {
                                e.preventDefault();
                            };

                            // Disable right-click on the iframe
                            iframe.addEventListener('contextmenu', disableRightClick);

                            // Add event listener to disable right-click after the content is loaded
                            iframe.addEventListener('load', function () {
                                iframe.contentDocument.addEventListener('contextmenu', disableRightClick);
                            });

                            // Append the close button and iframe to the overlay
                            overlay.appendChild(closeButton);
                            overlay.appendChild(iframe);

                            // Append the overlay to the main container
                            mainContainer.appendChild(overlay);

                            // Add event listener to close the overlay when the close button is clicked
                            closeButton.addEventListener('click', function () {
                                mainContainer.removeChild(overlay);
                            });
                        }
                    });
                });
            });
        </script>
    <?php else: ?>

            <?php
        endif;

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('portfolio', 'portfolio_shortcode');

// Add custom image size for portfolio items
function custom_portfolio_image_size() {
    add_image_size('custom_portfolio_size', 400, 600, true); // adjust width and height as needed
}

add_action('after_setup_theme', 'custom_portfolio_image_size');