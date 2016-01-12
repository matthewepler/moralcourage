<?php
    /**
     * Template Name: Tab 3 Layout
     */
    global $page;
    $tdLayoutId = 'td-layout-3';
    $testimnialListId = 'testimonial-list-td3';
    $content = get_custom_content( $page->ID,  array($tdLayoutId, $testimnialListId));
    if (isset($content[$tdLayoutId]['video-list'])) {
        $videoCategory = $content[$tdLayoutId]['video-list'];
    }
    ?>

        <article class="tab-layout tab3">

            <h2><?php print_content($content['alternative-page-title']); ?></h2>
            <section class="testimonials">
                <h3 class="section-title">
                    <?php print_content($content[$tdLayoutId]['bottom-region-title']);?>
                </h3>
                <?php print_content($content[$tdLayoutId]['bottom-region']);?>
                <?php

                if (isset($content[$testimnialListId])) :
                    $count = 0;

                    if (isset($content[$testimnialListId]['author'])) {
                        $list = $content[$testimnialListId];
                        $content[$testimnialListId] = array();
                        $content[$testimnialListId] []= $list;
                        $count = 1;
                    }

                    foreach ($content[$testimnialListId] as $testimonial):
                    ?>
                        <div class="testimonial-box
                                <?php echo ($count % 3 == 0) ? 'arrow-bottom-right' : '';?>
                                <?php echo ($count % 3 == 1) ? 'arrow-top-left' : '';?>
                                <?php echo ($count % 3 == 2) ? 'arrow-top-right' : '';?>
                            ">
                            <em><?php print_content($testimonial['quote']); ?></em>
                            <b><?php print_content($testimonial['author']); ?></b>
                        </div>
                    <?php
                    $count++;
                    endforeach;
                endif;
                ?>
            </section>

            <div class="btn-container">
                <?php print_content($content[$tdLayoutId]['mid-region']);?>
            </div>
            <section class="section-video video-tabs clearfix">
                <article class="video-main clearfix">
                    <?php the_videos($videoCategory, 'main_video'); ?>
                </article>
                <aside class="shadow-div scroll-top">
                    <div class="video-thumbs">
                        <?php the_videos($videoCategory, 'thumb_video'); ?>

                    </div>
                </aside>
                <a class="load-more" href="#"><?php echo __('Load more videos'); ?></a>
            </section>
        </article>

    <?php



?>
