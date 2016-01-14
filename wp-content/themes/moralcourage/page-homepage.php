<?php
/**
 * Template Name: Homepage
 */
    wp_enqueue_style( 'homepage-css', get_stylesheet_directory_uri() . '/css/pages/homepage.css' );
    $content = get_custom_content(get_the_ID(), 'homepage-custom-content');
    get_header(); ?>

    <div class="container clearfix">
        <h1><?php print_content($content['alternative-page-title']); ?></h1>
        <section class="section-orange">
            <div class="picture-container orange-container">
                <?php the_images('role-modeling-images');?>
            </div>
            <div class="text-container">
                <h3 class="bold text-orange"><?php print_content($content['top-right-title']); ?></h3>
                <p><?php print_content($content['top-right-paragraph']); ?></p>

                <?php if($content['top-right-call-to-action']):?>
                    <a href="<?php print_content($content['top-right-call-to-action-link']); ?>">
                        <span class="text-orange" href=""><?php print_content($content['top-right-call-to-action']); ?></span>
                        <span class="btn-orange"><i class="fa fa-angle-double-right"></i></span>
                    </a>
                <?php endif;?>
            </div>
        </section>
        <section class="section-green">
            <div class="picture-container green-container">
                <?php the_images('teaching-images');?>
            </div>
            <div class="text-container">
                <h3 class="bold text-green"><?php print_content($content['left-title']); ?></h3>
                <p><?php print_content($content['left-paragraph']); ?></p>
                <?php if($content['left-call-to-action']):?>
                    <a href="<?php print_content($content['left-call-to-action-link']); ?>">
                        <span class="text-green" href=""><?php print_content($content['left-call-to-action']); ?></span>
                        <span class="btn-green"><i class="fa fa-angle-double-right"></i></span>
                    </a>
                <?php endif;?>
            </div>
        </section>
        <section class="section-blue">
            <div class="picture-container blue-container">
                <?php the_images('mentoring-images');?>
            </div>
            <div class="text-container">
                <h3 class="bold text-blue"><?php print_content($content['bottom-right-title']); ?></h3>
                <p><?php print_content($content['bottom-right-paragraph']); ?></p>
                <?php if($content['bottom-right-call-to-action']):?>
                    <a href="<?php print_content($content['bottom-right-call-to-action-link']); ?>">
                        <span class="text-blue"><?php print_content($content['bottom-right-call-to-action']); ?></span>
                        <span class="btn-blue"><i class="fa fa-angle-double-right"></i></span>
                    </a>
                <?php endif;?>
            </div>
        </section>
    </div>

<?php
get_footer();
