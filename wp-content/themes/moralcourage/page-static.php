<?php
/**
 * Template Name: Static Page
 */
    wp_enqueue_style( 'about-css', get_stylesheet_directory_uri() . '/css/pages/static.css' );
    $content = get_custom_content(get_the_ID(), 'static-custom-content');

    get_header(); ?>

    <div class="container clearfix">
        <?php while ( have_posts() ) : the_post(); ?>
        <h1 class="page-title"><?php print_content($content['alternative-page-title']); ?></h1>
        <p class="text-center"><?php print_content($content['subtitle']); ?></p>
        <section class="section-text">
            <?php the_content(); ?>
        </section>
        <?php endwhile;?>
    </div>
<?php
    get_footer();
