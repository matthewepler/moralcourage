<?php
    wp_enqueue_style( 'teaching-css', get_stylesheet_directory_uri() . '/css/pages/motivational.css' );
    get_header(); ?>

    <div class="container clearfix">
            <aside>
                <h2 class="page-title">Are You ...</h2>
                <div class="tabs">
                    <div id="tab1" class="tab active">
                        <div class="tab-header clearfix">
                            <div class="icon-container first-icon left">
                            </div>
                            <div class="text-container left">
                                <h3>A young person</h3>
                                <span>who feels alone because you want to do the right thing?</span>
                            </div>
                        </div>
                        <div class="tab-content active">
                            <h2>It's one thing to feel alone and another thing to be alone. </br> You are not alone.</h2>
                            <p>Check out these videos of other young people who are showing moral courage.</p>
                            <section class="section-video clearfix">
                                <div class="video-main clearfix">
                                    <?php the_videos('role-modeling-videos', 'main_video'); ?>
                                </div>
                                <div class="shadow-div">
                                    <div class="video-thumbs">
                                        <?php the_videos('role-modeling-videos', 'thumb_video'); ?>
                                        <a href="" class="load-more"> Load more videos</a>
                                    </div>
                                </div>
                            </section>
                            <section class="section-text">
                                <h2>Inspired? Then we have a few more tips for you:</h2>
                                <p>Share your story with Irshad, founder of the Moral Courage Project.</p>
                                <p class="middle-paragraph">If you have a specific dilemma that requires you to face your fears, contact our Guidance Team. It's free and confidential. </p>
                                <p>Talk to us through Twitter and Facebook.</p>
                                <span>Ask your school to get involved in the Moral Courage Project. Send this link to your teachers and principal:</span>
                                <a href="">moralcourage.org/educators</a>
                            </section>
                        </div>
                    </div>
                    <div id="tab2" class="tab">
                        <div class="tab-header clearfix">
                            <div class="icon-container second-icon left">
                            </div>
                            <div class="text-container left">
                                <h3>A student of public service</h3>
                                <span>who is passionate about fixing government</span>
                            </div>
                        </div>
                        <div class="tab-content">
                        </div>
                    </div>
                    <div id="tab3" class="tab">
                        <div class="tab-header clearfix">
                            <div class="icon-container third-icon left">
                            </div>
                            <div class="text-container left">
                                <h3>An event organizer</h3>
                                <span>who dreams of transforming and not just motivating your audiences?</span>
                            </div>
                        </div>
                        <div class="tab-content">
                        </div>
                    </div>
                    <div id="tab4" class="tab">
                        <div class="tab-header clearfix">
                            <div class="icon-container fourth-icon left">
                            </div>
                            <div class="text-container left">
                                <h3>An educator</h3>
                                <span>dedicated to developing gutsy global citizens?</span>
                            </div>
                        </div>
                        <div class="tab-content">
                        </div>
                    </div>
                    <div id="tab5" class="tab">
                        <div class="tab-header clearfix">
                            <div class="icon-container fifth-icon left">
                            </div>
                            <div class="text-container left">
                                <h3>A business executive</h3>
                                <span>who wants to leave a legacy of integrity?</span>
                            </div>
                        </div>
                        <div class="tab-content">
                        </div>
                    </div>
                    <div id="tab6" class="tab">
                        <div class="tab-header clearfix">
                            <div class="icon-container sixth-icon left">
                            </div>
                            <div class="text-container left">
                                <h3>A spirtual lider</h3>
                                <span>who seeks to free your people from narrow interpretation?</span>
                            </div>
                        </div>
                        <div class="tab-content">
                        </div>
                    </div>
                </div>
            </aside>
    </div>
<?php
get_footer();
