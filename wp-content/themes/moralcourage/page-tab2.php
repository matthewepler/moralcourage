<?php
    /**
     * Template Name: Tab 2 Layout
     */
    global $page;
    $content = get_custom_content( $page->ID, 'td-layout-2');

    $videoCategory = $content['video-list'];
    ?>

        <article class="tab-layout tab2">

            <h2><?php print_content($content['alternative-page-title']); ?></h2>
            <p><?php print_content($content['subtitle-paragraph']); ?></p>
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
            <section class="section-text">
                <h2><?php print_content($content['under-video-title']); ?></h2>
                <?php if ($content['under-video-col-1']): ?>
                    <p class="paragraph col"><?php print_content($content['under-video-col-1']); ?></p>
                <?php endif; ?>
                <?php if ($content['under-video-col-2']): ?>
                    <p class="middle paragraph col"><?php print_content($content['under-video-col-2']); ?></p>
                <?php endif; ?>
                <?php if ($content['under-video-col-3']): ?>
                    <p class="paragraph col"><?php print_content($content['under-video-col-3']); ?></p>
                <?php endif; ?>
                <p class="last paragraph">
                    <?php print_content($content['last-paragraph']); ?>
                </p>
            </section>
        </article>

    <?php



?>
