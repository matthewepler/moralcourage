<?php
/**
 * Template Name: About Page
 */
    wp_enqueue_style( 'about-css', get_stylesheet_directory_uri() . '/css/pages/about.css' );

    $content = get_custom_content(get_the_ID(), 'custom-content');

    get_header(); ?>

    <div class="container clearfix">
        <h1 class="page-title"><?php print_content($content['alternative-page-title']);?></h1>
        <section class="section-text">
            <div class="top clearfix">
                <div class="round-container green-container">
                    <span class="bold"><?php print_content($content['green-circle-region']);?></span>
                </div>
                <div class="text-container">
                    <p><?php print_content($content['green-circle-right-paragraph']);?></p>
                </div>
            </div>
            <div class="bottom clearfix">
                <div class="round-container blue-container">
                    <span class="bold"><?php print_content($content['blue-circle-region']);?></span>
                </div>
                <div class="text-container">
                    <p><?php print_content($content['blue-circle-right-paragraph']);?></p>
                </div>
            </div>
        </section>
        <section class="section-video">
            <?php the_videos('about-videos', 'about_video'); ?>
        </section>
    </div>
<?php
    get_footer();
