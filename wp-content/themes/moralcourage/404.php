<?php
/**
 * Template Name: Contact Page
 */
    wp_enqueue_style( 'mentoring-css', get_stylesheet_directory_uri() . '/css/pages/404.css' );
    get_header(); ?>

    <div class="container clearfix">
        <span class="title">404</span>
        <h2 class="page-title">We are sorry.</h2>
        <div class="error-text">
            <p>The page you are looking for doesn't exist!.</p>
            <p>Go to <a href="/homepage">Homepage</a> or <a href="/contact">Contact Us</a> about the problem.</p>
        </div>


    </div>

<?php
get_footer();
