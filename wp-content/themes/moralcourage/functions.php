<?php

set_include_path(__DIR__);

function get_custom_content($postId, $slugs = '') {
	$content = array();
	$common_content = get_post_meta( $postId, 'page-common-content', true );

	if ($common_content) {
		$common_content = $common_content[0];
	}

	if (!$slugs) {
		return $common_content;
	}

	if (is_array($slugs)) {

		foreach ($slugs as $slug) {
			$meta = get_post_meta( $postId, $slug, true  );
			if (sizeof($meta) == 1) {
				$meta = $meta[0];
			}
			$content[$slug] = $meta;
		}
	} else {

		$meta = get_post_meta( $postId, $slugs, true);

		if (sizeof($meta) == 1) {
			$meta = $meta[0];
		}
		if (is_array($meta)) {
			$content = array_merge($content, $meta);
		}

	}
	if (sizeof($content)) {
		$content = array_merge($common_content, $content);
	}

	return $content;
}
function the_page_color($postId) {
    $common_content = get_custom_content($postId);
    if (isset($common_content['page-color'])) {
        $color = $common_content['page-color'];    
    } else {
        $color = '';
    }
    
    if (strlen($color) > 0) {
        page_color_override($color);
    }
    
    return $color;
}
function page_color_override($color) {

    ?>
    <style>
    .nav-menu .menu-item a:hover,
    .nav-menu .menu-item:hover a,
    .nav-menu .menu-item.current-menu-item a {
        color: <?php echo $color;?> !important;
    }
    .nav-menu .menu-item a:before {
        background: <?php echo $color;?> !important;
    
    }
    .page {
        background: <?php echo $color;?> !important;
    }
    </style>
    <?php
}
function print_content($input) {
	echo do_shortcode($input);
}
function the_thumbnail_swapping_images($postId, $slug, $imageHtml) {
	$images = get_post_meta( $postId, $slug, true );
	$IMAGE_HTML = array(
		'default_images' => 'default_images_html'
	);

	if ($images) {
		?>
		<ul class="swapping-images">
	<?php
		foreach ( $images as $image ) {
			$imageData['thumbnail'] = wp_get_attachment_image_src($image['swapping-image'], null, false);
			$imageData['thumbnail'] = $imageData['thumbnail'][0];
			$IMAGE_HTML[$imageHtml]($imageData);
		}
		?>
		</ul>
	<?php
	}
}
function the_masked_image($imageId, $imageHtml = 'default_image') {
	$IMAGE_HTML = array(
		'default_image' => 'masked_image_html',
		'simple_image'  => 'simple_masked_image_html'
	);
	$imageData['thumbnail'] = wp_get_attachment_image_src($imageId, null, false);
	$imageData['thumbnail'] = $imageData['thumbnail'][0];
	$IMAGE_HTML[$imageHtml]($imageData);
}

function get_posts_content($pages) {
	$results;

	global $page;
	foreach ($pages as $page) {
		$slug = $page->post_name;
		$template = get_page_template_slug($page->ID);
		$template = str_replace('.php', '',$template);
		$content = load_template_part($template);

		$results[$slug] = $content;

	}
	return $results;
}

function load_template_part($template_name, $part_name=null) {
    ob_start();
    get_template_part($template_name, $part_name);
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
function get_video_data($postId, $youtubeId) {
	$data = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id=' . $youtubeId . '&key=AIzaSyCgFIXES0mBx5de0IZzFyk2B25WCnnciDg'));
    $data = $data->items[0];

	$thumbnail = 'https://i.ytimg.com/vi/' . $youtubeId . '/hqdefault.jpg';
    $defaultThumbnail = 'https://i.ytimg.com/vi/' . $youtubeId . '/mqdefault.jpg';
    $title = $data->snippet->title;


    $maxViews = 100000;
    $viewCount = $data->statistics->viewCount;
    $viewCountFill = $viewCount / $maxViews * 100;
    if ($viewCountFill > 100) {
        $viewCountFill = 100;
    }

    $videoData = array(
        'videoId'   => $youtubeId,
        'thumbnail' => $thumbnail,
        'defaultThumbnail' => $defaultThumbnail,
        'title'     => $title,
		'link'      => 'https://www.youtube.com/watch?v=' . $youtubeId,
		'shortLink' => 'http://y2u.be/' . $youtubeId,
        'views'     => array(
            'count'     => $viewCount,
            'countFill' => $viewCountFill
        )
    );

    $meta = get_post_meta( $postId, 'youtube_video_embed', true );
    $meta = $meta[0];

    if (isset($meta['video-thumbnail']) && $meta['video-thumbnail']) {

        $image = wp_get_attachment_image_src($meta['video-thumbnail'], null, false);
        $videoData['thumbnail'] = $image[0];
    }

    if (isset($meta['video-text']) && $meta['video-text']) {
        $videoData['text'] = $meta['video-text'];
    }

    if (isset($meta['alternative-video-title']) && $meta['alternative-video-title']) {
        $videoData['title'] = $meta['alternative-video-title'];
    }

    if (isset($meta['default-twitter-message']) && $meta['default-twitter-message']) {
        $videoData['twitter-message'] = $meta['default-twitter-message'];
        $videoData['shortLink'] = ' ';
    } else {
        $videoData['twitter-message'] = $videoData['title'];
    }

    return $videoData;
}
function get_youtube_id($postId) {
    $meta = get_post_meta( $postId, 'youtube_video_embed', true );


    preg_match('@embed\/\K.*?(?=\"|\?)@', $meta[0]['video-embed-code-or-link'], $videoId);

    if (!sizeof($videoId)) {
        preg_match('@watch\?v\=\K.+?(?=\"|\?|\&|$)@', $meta[0]['video-embed-code-or-link'], $videoId);
    }
    return $videoId[0];
}
function the_videos($videoCategorySlug = '', $videoHtml = 'default_video') {
    if (!$videoCategorySlug) {
        return;
    }
	$args = array(
		'post_type'     => 'video',
		'youtube_video' => $videoCategorySlug,
        'posts_per_page' => -1
	);
    

	$VIDEO_HTML = array(
		'default_video' => 'default_video_html',
		'about_video'   => 'about_video_html',
        'thumb_video'   => 'thumb_video_html',
        'main_video'    => 'main_video_html',
		'role_modeling_main_video' => 'role_modeling_main_video_html',
		'founder_video' => 'founder_video_html'
	);

    $posts = get_posts( $args );

    if ($posts) {

        foreach ( $posts as $post ) {

            $youtubeId = get_youtube_id($post->ID);

            $videoData = array(
                'thumbnail' => null,
                'views' => null,
				'text'  => null,
                'twitter-message' => null,
                'permalink' => get_permalink($post->ID)
            );

            $videoData = array_merge($videoData, get_video_data($post->ID, $youtubeId));

            if ($videoData['thumbnail']) {
            	$VIDEO_HTML[$videoHtml]($videoData);
            }

            the_excerpt();
        }

    }
}

function the_images($imagesCategorySlug = '', $imageHtml = 'default_images') {
	$args = array(
		'post_type'      => 'images',
		'swapping_image' => $imagesCategorySlug,
        'posts_per_page' => -1,
	);


	$IMAGE_HTML = array(
		'default_images' => 'default_images_html'
	);

    $posts = get_posts( $args );

    if ($posts) {
    	?>
    	<ul class="swapping-images">
    <?php
        foreach ( $posts as $post ) {
            $meta = get_post_meta( $post->ID, 'swapping_pictures', true );
            $imagesData = $meta;
            foreach ($imagesData as $key => $imageData) {

        		$imageData['thumbnail'] = wp_get_attachment_image_src($imageData['image'], null, false);
        		$imageData['thumbnail'] = $imageData['thumbnail'][0];

            	$IMAGE_HTML[$imageHtml]($imageData);
            }
        }
          ?>
    	</ul>
    <?php
    }
}
function the_daily_images($imagesCategorySlug = '', $imageHtml = 'default_images') {
	$args = array(
		'post_type'      => 'daily_images',
		'daily_image'    => $imagesCategorySlug,
        'posts_per_page' => -1,
	);


	$IMAGE_HTML = array(
		'default_images' => 'masked_image_html'
	);

	$posts = get_posts( $args );
	$weekDays = array(
		'',
		'Monday',
		'Tuesday',
		'Wednesday',
		'Thursday',
		'Friday',
		'Saturday',
		'Sunday'
	);
	$weekDayNumber = date('N');
	$imageData = array();

	foreach ( $posts as $post ) {
		$meta = get_post_meta( $post->ID, 'daily_images_custom_content', true );
		if (!sizeof($meta)) {
			continue;
		}
		$meta = $meta[0];
		if ($weekDays[$weekDayNumber] == $meta['day-of-week']) {
			$imageData = get_daily_image_data($meta);
			$IMAGE_HTML[$imageHtml]($imageData);
			break;
		}
	}
	return $imageData;
}

function get_daily_image_data($meta) {
	$image = $meta['image'];
	$imageData['image-text'] = $meta['image-text'];
	$imageData['image-title'] = $meta['alternative-image-title'];

	$imageData['thumbnail'] = wp_get_attachment_image_src($image, null, false);
	$imageData['thumbnail'] = $imageData['thumbnail'][0];
	return $imageData;
}
function the_slug($echo = true){
	$slug = basename(get_permalink());
	do_action('before_slug', $slug);
	$slug = apply_filters('slug_filter', $slug);

	if( $echo ) {
		echo $slug;
	}

	do_action('after_slug', $slug);
	return $slug;
}
function default_images_html($imageData) {
	$maskId = rand();
	?>
	<li class="item mask grunge" data-text-target=".slider-text">
		<?php if (isset($imageData['image-text'])): ?>
		<div class="item-text">
			<?php echo $imageData['image-text']; ?>
		</div>
		<?php endif; ?>
		<div class="svgMask">
            <svg width="100%" height="100%" baseProfile="full" version="1.2">
                <defs>
                    <mask id="svgmask<?php echo $maskId;?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" transform="scale(1)">
                        <image width="100%" height="100%"
                        	xlink:href="<?php echo get_stylesheet_directory_uri();?>/images/grunge-mask-alt.png"/>
                    </mask>
                </defs>
                <image mask="url(#svgmask<?php echo $maskId;?>)" width="100%" height="100%" y="0" x="0"
                	xlink:href="<?php echo $imageData['thumbnail']; ?>"/>
            </svg>
        </div>
	</li>

<?php
}

function masked_image_html($imageData) {
	$maskId = rand();
	?>
	<div class="mask grunge">
		<div class="svgMask">
			<svg width="100%" height="100%" baseProfile="full" version="1.2">
				<defs>
					<mask id="svgmask<?php echo $maskId;?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" transform="scale(1)">
						<image width="100%" height="100%"
							xlink:href="<?php echo get_stylesheet_directory_uri();?>/images/grunge-mask-alt.png"/>
					</mask>
				</defs>
				<image mask="url(#svgmask<?php echo $maskId;?>)" width="100%" height="100%" y="0" x="0"
					xlink:href="<?php echo $imageData['thumbnail']; ?>"/>
			</svg>
		</div>
	</div>
<?php
}
function simple_masked_image_html($imageData) {
	?>
	<div class="mask simple">
		<img src="<?php echo $imageData['thumbnail']; ?>" width="100%" height="100%" />
	</div>
<?php
}
function default_video_html($videoData) {
	$maskId = rand();
	?>
	 <a class="video-link mask grunge lightbox" rel="lightbox" href="<?php echo the_permalink();?>">
        <div class="svgMask">
            <svg width="100%" height="100%" baseProfile="full" version="1.2">
                <defs>
                    <mask id="svgmask<?php echo $maskId;?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" transform="scale(1)">
                        <image width="100%" height="100%" xlink:href="<?php echo get_stylesheet_directory_uri();?>/images/grunge-mask-alt.png"/>
                    </mask>
                </defs>
                <image mask="url(#svgmask<?php echo $maskId;?>)" width="180%" height="100%" y="0" x="0" xlink:href="<?php echo $videoData['thumbnail']; ?>"/>
            </svg>
        </div>
        <span><?php echo $videoData['views']['count']; ?></span>
        <h3 class="title"><?php echo $videoData['title']; ?></h3>
    </a>
<?php
}
function thumb_video_html($videoData) {
    ?>
     <a class="item" href="<?php echo the_permalink();?>" data-target="video-<?php echo $videoData['videoId']; ?>">
        <img src="<?php echo $videoData['defaultThumbnail']; ?>"/>
        <p class="title"><?php echo $videoData['title']; ?></p>
    </a>
<?php
}
function main_video_html($videoData) {
	$maskId = rand();

    ?>

    <div class="item clearfix" id="video-<?php echo $videoData['videoId']; ?>">
		<h2 class="title"><?php echo $videoData['title']; ?></h2>
        <section class="left">
            <a data-fancybox-type="ajax" href="<?php echo $videoData['permalink'];?>" class="video-link mask grunge fancybox">
                <div class="svgMask">
                    <svg width="100%" height="100%" baseProfile="full" version="1.2">
                        <defs>
                            <mask id="svgmask<?php echo $maskId;?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" transform="scale(1)">
                                <image width="100%" height="100%" xlink:href="<?php echo get_stylesheet_directory_uri();?>/images/grunge-mask-alt.png"/>
                            </mask>
                        </defs>
                        <image mask="url(#svgmask<?php echo $maskId;?>)" width="180%" height="180%" y="-150" x="-90" xlink:href="<?php echo $videoData['thumbnail']; ?>"/>
                    </svg>
                </div>
                <div class="play-button"></div>
            </a>
            <p class="video-tip"><?php echo $videoData['text']; ?></p>
        </section>
        <?php video_info_html($videoData); ?>
    </div>
<?php
}
function video_info_html($videoData) {
?>
	<section class="video-info">

		<?php view_range_html($videoData); ?>
		<span class="video-subtitle">Help this story reach 100,000 people</span>
		<span class="social-btn btn-facebook">
			<i class="fa fa-facebook"></i>
			Share
			<div class="fb-share-button" data-href="<?php echo $videoData['link']; ?>" data-width="50" data-height="30"></div>
		</span>

		<span class="social-btn btn-tweet" href="">
			<i class="fa fa-twitter"></i>
			Tweet
			<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php echo $videoData['twitter-message']; ?>" data-url="<?php echo $videoData['shortLink']; ?>"></a>

		</span>
		<br/>
		<a href="https://www.youtube.com/channel/UCbp94Mntcb2IV9n4BtHXpUg?sub_confirmation=1" class="social-btn btn-youtube" target="_blank" >

			<i class="fa fa-youtube-play"></i>
			Subscribe on YouTube
		</a>


	</section>
<?php
}
function social_include() {?>
<script>
	if (typeof FB !== 'undefined') {
		FB.XFBML.parse();
	} else {
		(function (d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=446171915496788&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	}

	if (typeof twttr !== 'undefined') {
		twttr.widgets.load();
	} else {
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
	}
</script>
<?php }

function survey_include() { ?>
    <div class="survey-form">
        <?php echo do_shortcode('[contact-form-7 id="327" title="Easter Egg Question"]'); ?>
    </div>
    <div class="survey-tab active"><span class="icon-reversedR"></span></div>
<?php }
function role_modeling_main_video_html($videoData) {
	$maskId = rand();
	?>

	<div class="item clearfix" id="video-<?php echo $videoData['videoId']; ?>">

		<section class="left">
			<a data-fancybox-type="ajax" href="<?php echo $videoData['permalink'];?>" class="video-link mask grunge fancybox">
				<div class="svgMask">
					<svg width="100%" height="100%" baseProfile="full" version="1.2">
						<defs>
							<mask id="svgmask<?php echo $maskId;?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" transform="scale(1)">
								<image width="100%" height="100%" xlink:href="<?php echo get_stylesheet_directory_uri();?>/images/grunge-mask-alt.png"/>
							</mask>
						</defs>
						<image mask="url(#svgmask<?php echo $maskId;?>)" width="180%" height="180%" y="-150" x="-90" xlink:href="<?php echo $videoData['thumbnail']; ?>"/>
					</svg>
				</div>
				<div class="play-button"></div>
			</a>
			<p class="video-tip"><?php echo $videoData['text']; ?></p>
		</section>
		<h2 class="title"><?php echo $videoData['title']; ?></h2>
		<?php video_info_html($videoData); ?>
	</div>
<?php
}
function view_range_html($videoData) {
    ?>
    <div class="range">
        <div class="fill" style="width:<?php echo $videoData['views']['countFill'];?>%">
            <span class="amount"><?php echo $videoData['views']['count'];?> views</span>
        </div>
    </div>
<?php
}
function about_video_html($videoData) {
	$maskId = rand();
	?>
	<div class="video-player video-main">

        <a data-fancybox-type="ajax" href="<?php echo $videoData['permalink'];?>" class="video-link mask grunge fancybox">
			<div class="svgMask">
				<svg width="100%" height="100%" baseProfile="full" version="1.2">
					<defs>
						<mask id="svgmask<?php echo $maskId;?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" transform="scale(1)">
							<image width="100%" height="100%" xlink:href="<?php echo get_stylesheet_directory_uri();?>/images/grunge-mask-alt.png"/>
						</mask>
					</defs>
					<image mask="url(#svgmask<?php echo $maskId;?>)" width="180%" height="180%" y="-150" x="-90" xlink:href="<?php echo $videoData['thumbnail']; ?>"/>
				</svg>
			</div>
			<div class="play-button"></div>
		</a>
    </div>

<?php
}
function founder_video_html($videoData) {
     $maskId = rand();
    ?>
    <div class="video-player video-main">

        <a data-fancybox-type="ajax" href="<?php echo $videoData['permalink'];?>" class="video-link mask grunge fancybox">
            <div class="svgMask">
                <svg width="100%" height="100%" baseProfile="full" version="1.2">
                    <defs>
                        <mask id="svgmask<?php echo $maskId;?>" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" transform="scale(1)">
                            <image width="100%" height="100%" xlink:href="<?php echo get_stylesheet_directory_uri();?>/images/grunge-mask-alt.png"/>
                        </mask>
                    </defs>
                    <image mask="url(#svgmask<?php echo $maskId;?>)" width="180%" height="180%" y="-150" x="-90" xlink:href="<?php echo $videoData['thumbnail']; ?>"/>
                </svg>
            </div>
            <div class="play-button"></div>

        </a>
        <p><?php echo $videoData['text']; ?></p>
    </div>

<?php
}

function add_slug_body_class( $classes ) {
     global $post;
     if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

function get_main_email() {
	$email = get_bloginfo('admin_email');

	return 'mailto:' . antispambot($email);
}
function get_base_url($atts, $content) {
	$url = get_bloginfo('url');
	return $url;
}
add_shortcode( 'base_url', 'get_base_url' );
add_shortcode( 'main_email', 'get_main_email' );


function my_cpt_columns( $columns ) {
    $columns['weekday'] = 'Week Day';
    return $columns;
}
add_filter('manage_edit-daily_images_columns', 'my_cpt_columns');


function my_cpt_column( $colname, $cptid ) {
	$meta = get_post_meta( $cptid, 'daily_images_custom_content', true );
    if ( $colname == 'weekday' && $meta) {
		$meta = $meta[0];
		echo $meta['day-of-week'];
	}

}
add_action('manage_daily_images_posts_custom_column', 'my_cpt_column', 10, 2);
