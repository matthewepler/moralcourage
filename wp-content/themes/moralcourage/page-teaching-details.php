<?php
    wp_enqueue_style( 'teaching-css', get_stylesheet_directory_uri() . '/css/pages/teaching-details.css' );
    wp_enqueue_style( 'video-tabs', get_stylesheet_directory_uri() . '/css/modules/video-tabs.css' );
    wp_enqueue_script( 'video-tabs', get_stylesheet_directory_uri(). '/js/modules/video-tabs.js','','',true);
    wp_enqueue_script( 'teaching-css', get_stylesheet_directory_uri() . '/js/pages/teaching.js', null, null, true );
    $content = get_custom_content(get_the_ID(), 'teaching-details-custom-content');

    $args = array(
        'post_type' => 'page',
        'post_parent' => get_the_ID(),
        'order'  => 'ASC',
        'orderby' => 'menu_order'
    );

    $pages = get_children($args);
    $pageData   = json_encode(get_posts_content($pages));

    get_header(); ?>
    <script>
        var pageData = <?php echo $pageData; ?>
    </script>

    <section class="container clearfix">
            <aside class="tab-navigation">
            <!-- edited by m.epler 1/13/2016. Removed h2 and added image -->
			<!-- <h2 class="page-title">Are you...</h2> -->
               <div><img src="http://localhost/wp-content/themes/moralcourage/images/applied_courage.png" style="width:90%;padding-left:30%"></div>
                <div class="tabs">
                    <?php foreach ($pages as $page):
                        $count = 0;
                        $page_content = get_custom_content($page->ID); ?>
                        <div class="tab" id="tab-<?php echo $page->post_name; ?>" data-slug="<?php echo $page->post_name; ?>">
                            <a href="#<?php echo $page->post_name; ?>" class="tab-header clearfix">
                                <div class="icon-container left">
                                    <?php the_thumbnail_swapping_images($page->ID, 'page-thumbnails', 'default_images'); ?>
                                </div>
                                <div class="text-container left">
                                    <h3><?php print_content($page->post_title); ?></h3>
                                    <span> <?php print_content($page_content['page-excerpt']); ?> </span>
                                </div>
                            </a>
                            <div class="tab-content">

                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </aside>
    </section>
<?php
get_footer();
