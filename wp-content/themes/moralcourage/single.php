<?php
global $post;
setup_postdata( $post );
        ?>
        
        <article>

            <h2><?php the_title(); ?></h2>

        </article>

    <?php


wp_reset_postdata();
?>
