        <footer id="footer">
            <div class="container clearfix">
                <div class="social-networks">
                    <a class="social-icon---youtube" target="_blank" href="https://www.youtube.com/user/MoralCourageChannel"><i class="fa fa-youtube"></i></a>
                    <a class="social-icon---facebook" target="_blank" href="https://www.facebook.com/MoralCourage"><i class="fa fa-facebook"></i></a>
                    <a class="social-icon---twitter" target="_blank" href="https://twitter.com/MoralCourage"><i class="fa fa-twitter"></i></a>
                </div>
                <p class="copy">&copy; Moral Courage Project <?php echo current_time('Y') ?>. All Rights Reserved. Moral Courage, the <span class="icon-logo"></span> logo, and the Moral Courage logo are trademarks and service marks owned by Moral Courage LLC. Any unauthorized use of these names, or variations of these names, is a violation of state, federal, and international trademark laws.</p>
                <nav id="footerNav" class="footer-nav">

                    <?php wp_nav_menu(array('theme_location' => 'footer-menu')); ?>

                </nav>
            </div>
        </footer>

        <!-- Place js files here -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/libs/fancybox/jquery.fancybox.js"></script>
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/libs/ua-parser/ua-parser.js"></script>

        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/modules/video-youtube.js"></script>
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/modules/swapping-images.js"></script>
        <?php wp_footer(); ?>
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/main.js"></script>

        <!-- Google Analytics -->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-57975161-1', 'auto');
          ga('send', 'pageview');

        </script>
        <!-- Crazzy Egg -->
        <script type="text/javascript">
        setTimeout(function(){var a=document.createElement("script");
        var b=document.getElementsByTagName("script")[0];
        a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0027/9280.js?"+Math.floor(new Date().getTime()/3600000);
        a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
        </script>

        <!-- Optimizely -->
        <script src="//cdn.optimizely.com/js/2299600098.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                var parser = new UAParser();
                var userDevice = parser.getDevice();
                if (userDevice.model == 'iPhone') {
                    $('.social-icon---youtube').attr('href', "vnd.youtube://user/moralcouragechannel");
                    $('.social-icon---facebook').attr('href', "fb://profile/134654046650348");
                    $('.social-icon---twitter').attr('href', "twitter://user?id=43139320");

                    $('.page-role-modeling .btn-tweet').each(function() {
                        deepLink = 'twitter://post?message=' + encodeURI($(this).data('text') + ' ' + $(this).data('url'));
                        $(this).attr('href', deepLink);
                    });

                    $('.page-role-modeling .btn-youtube').each(function() {
                        $(this).attr('href', "vnd.youtube://user/moralcouragechannel");
                    });
                }
            });
        </script>

        <div id="fb-root"></div>
        <?php social_include();?>
    </body>
</html>
