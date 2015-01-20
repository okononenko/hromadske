<?php get_header(); ?>
<!-- Main content -->
<!-- Category header -->
<!-- /Category header -->
<div class="main-content category-container">
	<div class="main-two-columns">
		<!-- Sidebar -->
		<?php get_sidebar(); ?>
		<!-- /Sidebar -->
		<!-- Category content -->
		<section class="wide-main-column">
			<div class="news-block">
				<header>
					<span class="category-title"><?php single_cat_title(); ?></span>
				</header>
				<ul class="news-list">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php 
						$categoryPost = getCategoryPostData($post);
						$sticker = $categoryPost["sticker"];
					?>
					<li<?php if($sticker) echo ' class="sticker-'.$sticker.'"'; ?>>
						<a href="<?php the_permalink(); ?>">
							<span class="visual">
								<img src="<?php echo modImgURL($categoryPost["img_url"], 120, 84); ?>" alt="<?php echo $categoryPost["title"];?>">
							</span>
							<span class="content-block">
								<strong class="title"><?php echo $categoryPost["title"];?></strong>
								<span class="content"><?php echo $categoryPost["description"];?></span>
								<span class="features-list">
									<span class="date">
										<?php echo $categoryPost["date"];?>
										<span class="mark">, <?php single_cat_title(); ?></span>
									</span>
									<span class="views features"><?php echo $categoryPost["views_count"];?></span>
									<span class="comments features"><?php echo $categoryPost["comments_count"];?></span>
								</span>
							</span>
						</a>
					</li>
					<?php endwhile; else: endif; ?>
				</ul>
			</div>
			<div class="news-navigations">
				<?php
					$nextPosts = explode('"',get_next_posts_link()); 
					$nextPostsURL = isset($nextPosts[1]) ? $nextPosts[1] : "";
					$prevPosts = explode('"',get_previous_posts_link());
					$prevPostsURL = isset($prevPosts[1]) ? $prevPosts[1] : ""; 
					//TODO: Notice: Undefined offset: 1 in /var/www/jaroslav/data/www/test.kgtv.com.ua/wp-content/themes/KGTV/category.php on line 46
				?>
				<a href="<?php echo $prevPostsURL; ?>" class="prev"></a>
				<a href="<?php echo $nextPostsURL; ?>" class="next"></a>
			</div>
		</section>
		<!-- /Category content -->
	</div>
	<?php get_template_part("headlines"); ?>
</div>
<!-- /Main content -->
<?php get_footer(); ?>
