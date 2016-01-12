<?php
/**
 * Template Name: Mentoring Page
 */
    wp_enqueue_style( 'mentoring-css', get_stylesheet_directory_uri() . '/css/pages/mentoring.css' );
    $content = get_custom_content(get_the_ID(), 'mentoring-custom-content');
    get_header(); ?>

    <div class="container clearfix">
        <p class="bold"><?php print_content($content['subtitle-paragraph']); ?></p>
        <h2 class="page-title"><?php print_content($content['alternative-page-title']); ?></h2>

        <section class="section-text">
            <h3><?php print_content($content['main-paragraph']); ?></h3>
            <p><?php print_content($content['secondary-paragraph']); ?></p>
        </section>
        <section class="section-form">
            <div class="round-container">
                <div>
                    <h3>Ask your question</h3>

                    <?php
                        while ( have_posts() ) : the_post();

                            // Include the page content template.
                            the_content();
                        endwhile;
                     ?>
                </div>
            </div>
        </section>
    </div>
<?php
get_footer();
