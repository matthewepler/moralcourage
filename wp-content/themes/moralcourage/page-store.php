<?php
/**
 * Template Name: Store Page
 */
    wp_enqueue_style( 'store-css', get_stylesheet_directory_uri() . '/css/pages/store.css' );
    $content = get_custom_content(get_the_ID(), 'store-custom-content');
    get_header(); ?>

    <div class="container clearfix">
       <aside>
            <h2 class="page-title"><?php print_content($content['alternative-page-title']); ?></h2>
            <p><?php print_content($content['subtitle-paragraph']); ?></p>
            </br>
            <p><?php print_content($content['sub-subtitle-paragraph']); ?></p>
            <div class="product-pic-container">
                <?php the_masked_image($content['bottom-left-image'], 'simple_image'); ?>
            </div>
       </aside>
       <section>
            <ul class="products-list">
                <li class="list-item">
                    <a href="<?php print_content($content['product-1-link']); ?>" target="_blank"><?php the_masked_image($content['product-1-image']); ?></a>
                    <span><?php print_content($content['product-1-title']); ?></span>
                </li>
                <li class="list-item">
                    <a href="<?php print_content($content['product-2-link']); ?>" target="_blank"><?php the_masked_image($content['product-2-image']); ?></a>
                    <span><?php print_content($content['product-2-title']); ?></span>
                </li>
                <li class="list-item">
                    <a href="<?php print_content($content['product-3-link']); ?>" target="_blank"><?php the_masked_image($content['product-3-image']); ?></a>
                    <span><?php print_content($content['product-3-title']); ?></span>
                </li>
                <li class="list-item">
                    <a href="<?php print_content($content['product-4-link']); ?>" target="_blank"><?php the_masked_image($content['product-4-image']); ?></a>
                    <span><?php print_content($content['product-4-title']); ?></span>
                </li>
                <li class="list-item">
                    <a href="<?php print_content($content['product-5-link']); ?>" target="_blank"><?php the_masked_image($content['product-5-image']); ?></a>
                    <span><?php print_content($content['product-5-title']); ?></span>
                </li>
                <li class="list-item">
                    <a href="<?php print_content($content['product-6-link']); ?>" target="_blank"><?php the_masked_image($content['product-6-image']); ?></a>
                    <span><?php print_content($content['product-6-title']); ?></span>
                </li>
            </ul>
       </section>
    </div>
<?php
get_footer();
