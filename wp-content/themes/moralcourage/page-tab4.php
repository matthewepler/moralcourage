<?php
    /**
     * Template Name: Tab 4 Layout
     */
    global $page;
    $tdLayoutId = 'td-layout-4';
    $testimnialListId = 'testimonial-list-td4';
    $content = get_custom_content( $page->ID,  array($tdLayoutId, $testimnialListId));

    if (isset($content[$tdLayoutId]['video-list'])) {
        $videoCategory = $content[$tdLayoutId]['video-list'];
    }
    ?>

        <article class="tab-layout tab4">

            <h2><?php print_content($content['alternative-page-title']); ?></h2>
             <div class="btn-container" style="font-family:'open sans';font-weight:400;font-size:18px;line-height:1.4;color:#000">
                <?php print_content($content[$tdLayoutId]['mid-region']);?>
            </div>
            <section class="section-video video-tabs clearfix">
                <article class="video-main clearfix">
                    <?php the_videos($videoCategory, 'main_video'); ?>
                </article>
            </section>

            <p class="paragraph-container" style="margin-top:-50px">
                <?php print_content($content[$tdLayoutId]['mid-paragraph']);?>
            </p>
            <a href="/teaching/teaching-details/#our-services?" class="contact-btn">Discover our services for you</a>
            <section class="testimonials">
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



        </article>

    <?php



?>
