<?php
/*
Template Name: Portfolio Template
*/

get_header();

$args = array(
    'post_type' => 'portfolio',
    'posts_per_page' => -1,
);

$portfolio_query = new WP_Query($args);

if ($portfolio_query->have_posts()) :
    ?>
    <div class="portfolio-container">
        <?php while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); ?>
            <div class="portfolio-item">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="portfolio-thumbnail">
                        <?php the_post_thumbnail(); ?>
                        <div class="overlay">
                            <div class="overlay-content">
                                <p><?php echo esc_html(get_post_meta(get_the_ID(), '_short_description', true)); ?></p>
                                <a href="<?php echo esc_url(get_post_meta(get_the_ID(), '_project_link', true)); ?>" class="view-project-btn" target="_blank">View Project</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="portfolio-title">
                    <h2><?php the_title(); ?></h2>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
endif;

wp_reset_postdata();

get_footer();
