<?php
/**
 * Template Name: Contact Page
 */
    wp_enqueue_style( 'mentoring-css', get_stylesheet_directory_uri() . '/css/pages/contact.css' );
    $content = get_custom_content(get_the_ID(), array('contact-custom-content', 'social-feeds'));
    get_header(); ?>

    <div class="container clearfix">
        <h2 class="page-title"><?php print_content($content['alternative-page-title']); ?></h2>
        <?php
        while ( have_posts() ) : the_post(); ?>
            <article>
                <?php the_masked_image($content['contact-custom-content']['form-image']); ?>

                <h4><?php print_content($content['contact-custom-content']['form-entry-paragraph']); ?></h4>
                
                <?php the_content(); ?>
            </article>
            <aside>
                <section class="twitter-feed">
                    <?php echo $content['social-feeds']['twitter-feed']?>
                </section>
                <section class="facebook-feed">
                    <?php echo $content['social-feeds']['facebook-feed']; ?>
                </section>
            </aside>

            <?php
        endwhile;
        ?>
    </div>
<?php
    survey_include();
    get_footer();
