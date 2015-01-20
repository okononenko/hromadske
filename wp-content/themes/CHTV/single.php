<?php get_header(); ?>
<!-- Main content -->
<!-- Post header -->
<?php
	//views
	increaseViewsCount($post -> ID);

	//comments
	//TODO: get post comments count
	update_post_meta($post -> ID, "comments_count", "0");

	$postID = $post -> ID;
	$title = $post -> post_title;
	$content = $post -> post_content;
	$date = singlePostDate($post);
	$sticker = getPostSticker($postID);

	// Media default:
	// width: 630px
	// height: 354px
	$media;
	$postVideoURL = get_post_meta($postID, "post_video", true);
	if($postVideoURL){
		$media = postVideoCodeFromURL($postVideoURL);
	}else{
		$postImgURL = get_post_meta($postID, "post_img", true);
		if($postImgURL) $media = '<img src="'.modImgURL($postImgURL, 630, 354).'" />';
	}
?>
<header class="main-heading">
	<h1 class="title"><?php echo $title; ?></h1>
	<span class="subscribe">
		<?php echo $date ?>
	</span>
</header>
<!-- /Post header -->
<div class="main-content post-container">
	<div class="main-two-columns">
		<!-- Sidebar -->
		<?php get_sidebar(); ?>
		<!-- /Sidebar -->
		<!-- Post content -->
		<section class="wide-main-column">
			<article class="main-article">
				<div class="article-media">
					<!-- Sticker -->
					<?php 
						if($sticker) echo '<span class="sticker-'.$sticker.'"></span>';
					?>
	                <!-- Sticker -->
					<?php if($media) echo $media; ?>
				</div>
<!-- 				<div class="add-topics">
					<strong class="title">ДО ТЕМИ</strong>
					<ul class="topics-list">
						<li>
							<a href="#">
								<span class="content">Порошенко: Мене не цікавить, що Путін думає про Україну</span>
							</a>
							<span class="features-list">
								<span class="features views">40637</span>
								<span class="features comments">29</span>
							</span>
						</li>
					</ul>
				</div> -->
				<ul class="article-controls">
					<li><div class="fb-like" data-href="<?php the_permalink();?>" data-layout="button_count" data-action="like"></div></li>
					<li style="width: 80px; margin-top: 3px"><a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-count="horizontal">Tweet</a></li>
					<li style="width: 85px"><div id="vk_like-1"></div></li>
					<li style="width: 65px; margin-top: 3px"><div class="g-plusone"></div></li>
				</ul>
				<div class="text-wrap">
					<?php echo wpautop($content); ?>
            	</div>
            	<?php if (current_user_can("edit_posts")) : ?>
            	<?php $editURL = getPostEditLink($post -> ID); ?>
            	<div class="acrticle-edit">
            		<span class="edit">
            			<a href="<?php echo $editURL; ?>">Редактировать</a>
            		</span>
            	</div>
            	<?php endif; ?>
			</article>
			<div class="article-social-control-block">
        		<span class="counter">
        			<span class="comments-count-holder"><?php echo getPostCommentsCount($post -> ID); ?></span>
        			<span class="descr">коментарів</span>
        		</span>
        		<span class="counter light">
					<?php echo getPostViewsCount($post -> ID); ?>
					<span class="descr">переглядів</span>
        		</span>
        		<ul class="social-control-widgets">
        			<li class="facebook" style="width: 78px; margin-top: -4px">
        				<div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-type="box_count"></div>
        			</li>
        			<li class="twitter" style="width: 70px">
        				<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-count="vertical">Tweet</a>
        			</li>
        			<li class="vk" style="width: 50px; margin-top: 6px">
						<div id="vk_like-2"></div>
        			</li>
        			<li class="google" style="width: 90px">
						<div class="g-plus" data-action="share" data-annotation="vertical-bubble" data-height="60"></div>
        			</li>
        		</ul>
        	</div>
			<?php get_template_part("comments"); ?>
		</section>
		<!-- /Post content -->
	</div>
	<?php get_template_part("headlines"); ?>
</div>
<!-- /Main content -->
<?php get_footer(); ?>

