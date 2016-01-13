<?php
    /**
     * Template Name: Tab 1 Layout
     */
    global $page;

    // $content = get_custom_content( 107, 'td-layout-1');
    $content = get_custom_content( $page->ID, array('td-layout-1', 'testimonial-list'));

        ?>

        <article class="tab-layout tab1">

            <h2><?php print_content($content['alternative-page-title']);?></h2>
            <section class="section-text clearfix">
                <div class="left-column">
                    <?php if ($content['td-layout-1']['left-first-paragraph']) :?>
                    <p class="paragraph-container">
                        <?php print_content($content['td-layout-1']['left-first-paragraph']);?>
                    </p>
                    <?php endif;?>
                    <?php if ($content['td-layout-1']['left-second-paragraph']) :?>
                    <p class="paragraph-container">
                        <?php print_content($content['td-layout-1']['left-second-paragraph']);?>
                    </p>
                    <?php endif;?>
                    <?php if ($content['td-layout-1']['left-third-paragraph']) :?>
                    <p class="paragraph-container">
                        <?php print_content($content['td-layout-1']['left-third-paragraph']);?>
                    </p>
                    <?php endif;?>
                </div>
                <div class="right-column">
                    <?php if ($content['td-layout-1']['right-paragraph']) :?>
                    <p class="paragraph-container">
                        <?php print_content($content['td-layout-1']['right-paragraph']);?>
                    </p>
                    <?php endif;?>
                </div>
            </section>
            <div class="btn-container" style="text-align:left;font-size:125%;line-height:1.25">
                <?php print_content($content['td-layout-1']['mid-region']);?>
            </div>
            <section class="testimonials">
                <h3 class="section-title">
                    <?php print_content($content['td-layout-1']['bottom-region-title']);?>
                </h3>
                <?php print_content($content['td-layout-1']['bottom-region']);?>
                <?php

                if (isset($content['testimonial-list'])) :
                    $count = 0;

                    if (isset($content['testimonial-list']['author'])) {
                        $list = $content['testimonial-list'];
                        $content['testimonial-list'] = array();
                        $content['testimonial-list'] []= $list;
                        $count = 1;
                    }

                    foreach ($content['testimonial-list'] as $testimonial):
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
