<?php
/**
 * Template Name: Teaching Page
 */
    wp_enqueue_style( 'teaching-css', get_stylesheet_directory_uri() . '/css/pages/teaching.css' );
    $content = get_custom_content(get_the_ID(), 'teaching-custom-content');


    $detailsPage     = get_page_by_path('teaching/teaching-details');
    $detaislPageId   = $detailsPage->ID;
    $detailsPageLink = get_the_permalink($detaislPageId);

    $postCategory = get_category_by_slug('teaching')->cat_ID;


    get_header(); ?>

    <div class="container clearfix">
        <p class="bold"><?php print_content($content['alternative-page-title']); ?></h2>
        <h2><?php print_content($content['subtitle']); ?></h2>
        <section>
            <?php
                $args_left = array(
                    'posts_per_page' => 3,
                    'post_type' => 'page',
                    'offset'   => 0,
                    'post_parent' => $detaislPageId,
                    'order'  => 'ASC',
                    'orderby' => 'menu_order'
                );
                $args_right = array(
                    'posts_per_page' => 3,
                    'post_type' => 'page',
                    'offset'   => 3,
                    'post_parent' => $detaislPageId,
                    'order'  => 'ASC',
                    'orderby' => 'menu_order'
                );

                $pages_left = get_children($args_left);
                $pages_right = get_children($args_right);

                $iteratorClassMap = array(
                    'first',
                    'second',
                    'third',
                    'fourth',
                    'fifth',
                    'sixth'
                );
                ?>
            <div class="left-content">
                <?php
                $count = 0;

                foreach ($pages_left as $page):
                    $page_content = get_custom_content($page->ID);
                    ?>
                    <article class="item <?php echo $iteratorClassMap[$count]; ?> clearfix">
                        <div class="icon-container">
                            <?php the_thumbnail_swapping_images($page->ID, 'page-thumbnails', 'default_images'); ?>
                        </div>
                        <div class="text-container">
                            <a href="<?php echo $detailsPageLink .'#' . $page->post_name; ?>" title="<?php echo $page->post_title; ?>">
                                <?php print_content($page->post_title); ?>
                                <i class="fa fa-angle-double-left"></i>
                            </a>
                            <span> <?php print_content($page_content['page-excerpt']); ?> </span>
                        </div>

                    </article>
                <?php
                    $count++;
                endforeach;

                ?>

            </div>
            <div class="right-content">
                <?php

                foreach ($pages_right as $page):
                    $page_content = get_custom_content($page->ID);
                    ?>
                    <article class="item <?php echo $iteratorClassMap[$count]; ?> clearfix">
                        <div class="icon-container">
                            <?php the_thumbnail_swapping_images($page->ID, 'page-thumbnails', 'default_images'); ?>
                        </div>
                        <div class="text-container">
                            <a href="<?php echo $detailsPageLink .'#' . $page->post_name; ?>" title="<?php echo $page->post_title; ?>">
                                <?php print_content($page->post_title); ?>
                                <i class="fa fa-angle-double-right"></i>
                            </a>
                            <span> <?php echo $page_content['page-excerpt']; ?> </span>
                        </div>

                    </article>
                <?php
                    $count++;
                endforeach;

                ?>
            </div>
            <div class="background-center">
                <div class="round-text-container">
                    <span><?php print_content($content['central-title']);?></span>
                </div>
            </div>
        </section>
    </div>
<?php
get_footer();
