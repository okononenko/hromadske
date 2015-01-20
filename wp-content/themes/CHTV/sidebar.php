<!-- Post sidebar -->
<aside class="add-side">
	<!-- Social news -->
	<div class="aside-block">
		<h3 class="main-title">Популярне за тиждень</h3>
		<ul class="aside-social-news">
			<?php
				//TODO: get just last weeks posts
				$topPosts = array();
				$data = toolsApiRequest("news.posts.topviewed", array("count" => 5));
				if(isset($data -> posts)){
					$topPosts = $data -> posts;
				}
			?>
			<?php if (count($topPosts) > 0) : ?>
			<?php for ($i = 0; $i < count($topPosts); $i++):?>
			<?php
				$sidebarPost = getSidebarPostData(get_post($topPosts[$i]));
			?>
			<li>
				<a href="<?php echo $sidebarPost["url"]; ?>" class="social-news-item">
					<span class="visual">
						<img src="<?php echo modImgURL($sidebarPost["img_url"], 45, 45); ?>" alt="">
					</span>
					<span class="content">
						<span class="description"><?php echo $sidebarPost["title"]; ?></span>
						<span class="features-list">
							<span class="date">
								<?php echo $sidebarPost["date"]; ?>
								<span class="mark">, <?php echo $sidebarPost["category"]; ?></span>
							</span>
							<span class="views features"><?php echo $sidebarPost["views_count"]; ?></span>
							<span class="comments features"><?php echo $sidebarPost["comments_count"]; ?></span>
						</span>
					</span>
				</a>
			</li>
			<?php endfor; ?>
			<?php wp_reset_postdata();?>
			<?php endif; ?>
		</ul>
	</div>
	<!-- Social news -->
	<!-- Editor's news -->
	<div class="aside-block">
		<h3 class="main-title">Вибір редактора</h3>
		<ul class="aside-social-news">
			<?php
				$args = array('category_name' => 'main', 'posts_per_page' => 5);
				$the_query = new WP_Query( $args );
			?>
			<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php
				$sidebarPost = getSidebarPostData($post);
			?>
			<li>
				<a href="<?php echo $sidebarPost["url"]; ?>" class="social-news-item">
					<span class="visual">
						<img src="<?php echo modImgURL($sidebarPost["img_url"], 45, 45); ?>" alt="">
					</span>
					<span class="content">
						<span class="description"><?php echo $sidebarPost["title"]; ?></span>
						<span class="features-list">
							<span class="date">
								<?php echo $sidebarPost["date"]; ?>
								<span class="mark">, <?php echo $sidebarPost["category"]; ?></span>
							</span>
							<span class="views features"><?php echo $sidebarPost["views_count"]; ?></span>
							<span class="comments features"><?php echo $sidebarPost["comments_count"]; ?></span>
						</span>
					</span>
				</a>
			</li>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</ul>
	</div>
	<!-- /Editor's news -->
	<!-- Facebook page -->
	<div class="aside-block facebook-page">
		<h3 class="main-title">Facebook</h3>
		<div class="facebook-page-holder">
			<div class="fb-like-box" data-href="https://www.facebook.com/kgtv.kremenchug" data-width="299" data-height="299" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>
		</div>
	</div>
	<!-- /Facebook page -->
	<!-- VK page -->
	<div class="aside-block vk-page">
		<h3 class="main-title">VK</h3>
		<div class="vk-page-holder">
			<script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>
			<div id="vk_groups"></div>
			<script type="text/javascript">
			VK.Widgets.Group("vk_groups", {mode: 0, width: "299", height: "299", color1: 'FFFFFF', color2: '666', color3: 'ee7829'}, 69310253);
			</script>
		</div>
	</div>
	<!-- /Facebook page -->

</aside>
<!-- /Post sidebar