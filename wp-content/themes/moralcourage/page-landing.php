<?php
/**
 * Template Name: Landing Page
 */
    wp_enqueue_style( 'landing-css', get_stylesheet_directory_uri() . '/css/pages/landing.css' );
    $content = get_custom_content(get_the_ID(), 'landing-custom-content');
    get_header(); ?>

    <div class="container clearfix">
        <section id="landingPicture" class="landing-picture clearfix">
            <?php $imageData = the_daily_images('landing-page');?>
        </section>
        <section id="landingText" class="landing-text clearfix">
            <div class="field slider-text">
                <?php if (isset($imageData['image-title'])): ?>
                    <h2 class="title"><?php echo $imageData['image-title']; ?></h3>
                <?php endif; ?>
                <?php if (isset($imageData['image-text'])): ?>
                    <p><?php echo $imageData['image-text']; ?></p>
                <?php endif;?>
            </div>
            <span class="bold text-orange space-bottom-45"><?php print_content($content['alternative-page-title']); ?></span>

            <p><?php print_content($content['main-paragraph']); ?></p>
            </br>
            <a class="cta text-orange" href="<?php print_content($content['call-to-action-link']); ?>">
                <span class="bold"><?php print_content($content['call-to-action-text']); ?></span>
                <span class="btn-round-orange" href=""><i class="fa fa-angle-double-right"></i></span>
            </a>

        </section>
    </div>

<?php
get_footer();
