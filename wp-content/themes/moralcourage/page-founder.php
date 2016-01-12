<?php
/**
 * Template Name: Founder Page
 */
    wp_enqueue_style( 'founder-css', get_stylesheet_directory_uri() . '/css/pages/founder.css' );
    $content = get_custom_content(get_the_ID(), 'founder-custom-content');

    get_header(); ?>

    <div class="container clearfix">
        <h2 class="page-title"><?php print_content($content['alternative-page-title']); ?></h2>
        <span class="bold"><?php print_content($content['subtitle-region']); ?></span>
        <section class="section-text">
            <?php print_content($content['main-region']); ?>
        </section>
        <section class="section-video">
            
            <?php the_videos('founder-videos', 'founder_video'); ?>
        </section>
        <div class="external-links">
            <a href="<?php print_content($content['bottom-left-call-to-action-link']);?>" class="text-container">
                <span><?php print_content($content['bottom-left-title']); ?> <i class="fa fa-angle-double-right"></i></span>
                <p><?php print_content($content['bottom-left-paragraph']); ?></p>
                <?php the_masked_image($content['bottom-left-call-to-action-image']); ?>
            </a>


            <a href="<?php print_content($content['bottom-middle-call-to-action-link']);?>" class="text-container">
                <span><?php print_content($content['bottom-middle-title']); ?> <i class="fa fa-angle-double-right"></i></span>
                <p><?php print_content($content['bottom-middle-paragraph']); ?></p>
                <?php the_masked_image($content['bottom-middle-call-to-action-image']); ?>
            </a>


            <a href="<?php print_content($content['bottom-right-call-to-action-link']);?>" class="text-container">
                <span><?php print_content($content['bottom-right-title']); ?> <i class="fa fa-angle-double-right"></i></span>
                <p><?php print_content($content['bottom-right-paragraph']); ?></p>
                <?php the_masked_image($content['bottom-right-call-to-action-image']); ?>
            </a>

        </div>
    </div>
    
<?php
survey_include();
get_footer();
