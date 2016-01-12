<?php
	$id = get_the_ID();
	$youtubeId = get_youtube_id($id);
	$videoData = get_video_data($id, $youtubeId);
?>
<div class="video-container" id="playerContainer" data-video-id="<?php echo $youtubeId; ?>">
	<div id="player"></div>
	<section id="playerInfo" class="disabled">
		<h2 class="title"><?php get_the_title($id); ?></h2>
		<?php video_info_html($videoData);?>
	</section>
	<?php get_template_part('social');?>
</div>
<?php social_include();?>
<?php ?>
