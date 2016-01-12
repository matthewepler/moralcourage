<?php
/**
 * Template Name: Role Modeling Page
 */
    wp_enqueue_style( 'role-modeling-css', get_stylesheet_directory_uri() . '/css/pages/role-modeling.css' );
    wp_enqueue_style( 'video-tabs', get_stylesheet_directory_uri() . '/css/modules/video-tabs.css' );
    wp_enqueue_script( 'video-tabs', get_stylesheet_directory_uri(). '/js/modules/video-tabs.js','','',true);
    $content = get_custom_content(get_the_ID(), 'role-modeling-custom-content');
    get_header();
?>


    <div class="container clearfix">
        <h1 class="page-title"><?php print_content($content['alternative-page-title']);?></h1>
        <p class="subtitle"><?php print_content($content['subtitle-paragraph']); ?></p>
        <section class="section-video video-tabs">
            <article class="video-main clearfix">
                <?php the_videos('role-modeling-videos', 'role_modeling_main_video'); ?>
            </article>

            <aside class="video-thumbs-container">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/moral-tv.png" class="moral-tv"/>
                <div class="shadow-div scroll-top">
                    <div class="video-thumbs">
                        <?php the_videos('role-modeling-videos', 'thumb_video'); ?>
                    </div>
                </div>
                <a class="load-more" href="#"><?php echo __('Load more videos'); ?></a>
            </aside>
        </section>
    </div>
<?php
get_footer();
