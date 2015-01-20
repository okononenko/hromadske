<?php get_header(); ?>
<!-- Main content -->
<div class="main-content">
	<section class="content">
		<h2 class="main-title left-padding">Головне</h2>
		<div class="main-gallery" id="main-galery">
			<ul>
				<?php 
					$args = array('category_name' => 'main', 'posts_per_page' => 3);
					$the_query = new WP_Query( $args );
					$c = 0;
				?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php $first = true; while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php
						$c++;
						$liClass = "";
						if($c == 1) $liClass = "active";
						$mainContentPost = getMainContentPostData($post);
					?>
					<li class="<?php echo $liClass; ?>">
						<a href="<?php echo $mainContentPost["url"]; ?>">
							<img src="<?php echo modImgURL($mainContentPost["img_url"], 569, 362) ?>" alt="<?php echo $mainContentPost["title"]; ?>">
							<span><?php echo $mainContentPost["title"]; ?></span>
						</a>
					</li>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else:  ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>
			</ul>
			<a href="#" class="prev">prev</a>
			<a href="#" class="next">next</a>
		</div>
		<!-- Теми дня -->
		<h2 class="main-title left-padding">Теми тижня</h2>
		<div class="scroll-gallery" id="scroll-gallery">
			<div class="gallery-holder">
				<ul>
					<?php 
						$args = array('category_name' => 'week-topics');
						$the_query = new WP_Query( $args );
					?>
					<?php if ( $the_query->have_posts() ) : ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<?php 
							$weekPost = getMainFeedPostData($post);
						?>
						<li>
							<a href="<?php the_permalink(); ?>">
								<img src="<?php echo modImgURL($weekPost['img_url'], 254, 149) ?>" alt="">
								<div class="hover-block"> 
									<div class="block"> 
										<div class="column">
											<span class="ico-view"></span>
											<span class="num"><?php echo $weekPost["views_count"]; ?></span>
										</div> 
										<div class="column">
											<span class="ico-comment"></span>
											<span class="num"><?php echo $weekPost["comments_count"]; ?></span>
										</div>
									</div>
								</div>
							</a>
							<div class="content-holder">
								<a href="<?php the_permalink(); ?>"><?php echo $weekPost['title']; ?></a>
							</div>
						</li>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php else:  ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>
				</ul>
			</div>
			<a href="#" class="prev">prev</a>
			<a href="#" class="next">next</a>
		</div>
		<!-- /Теми дня -->
	</section>
	<!-- Newsline -->
	<aside class="newsline aside">
		<section class="aside-block">
			<header>
				<h3 class="main-title">Новини</h3>
			</header>
			<!-- <h4 class="period-title">вчора</h4> -->
			<ul class="aside-news-list">
				<?php 
					$args = array('category_name' => 'news', 'posts_per_page' => 10);
					$the_query = new WP_Query( $args );
				?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php 
						$newslinePost = getNewslinePostData($post);
						$sticker = $newslinePost["sticker"]; 
					?>

					<li<?php if($sticker) echo ' class="sticker-'.$sticker.'"'; ?>>
						<a href="<?php echo $newslinePost["url"] ?>">
							<span class="date"><?php echo $newslinePost["date"] ?></span>
							<span class="content"><?php echo $newslinePost["title"] ?></span>
						</a>
					</li>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<?php wp_reset_postdata(); ?>
				<?php else:  ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>
			</ul>
			<?php
				$newsID = get_cat_ID('Новини');
				$newsLink = get_category_link($newsID);
			?>
			<div class="btn-all-news">
				<a href="<?php echo $newsLink; ?>">Всі новини</a>
			</div>
		</section>
	</aside>
	<!-- /Newsline -->
	<div class="clear"></div>
	<!-- Main feed -->
	<!-- Add content -->
	<section class="add-content">
		<ul>
		<?php 
			$args = array('category_name' => 'main-feed', 'posts_per_page' => 9);
			$the_query = new WP_Query( $args );
		?>
		<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php $mainFeedPost = getMainFeedPostData($post); ?>
			<!-- the loop -->
			<li>
				<a href="<?php echo $mainFeedPost["url"] ?>">
					<span class="visual">
						<img src="<?php echo modImgURL($mainFeedPost["img_url"], 300, 200) ?>">
						<span class="mark left <?php echo $mainFeedPost["category_color"]; ?>">
							<?php echo $mainFeedPost["category"]; ?>
						</span>
						<div class="hover-block"> 
							<div class="block"> 
								<div class="column">
									<span class="ico-view"></span>
									<span class="num"><?php echo $mainFeedPost["views_count"]; ?></span>
								</div> 
								<div class="column">
									<span class="ico-comment"></span>
									<span class="num"><?php echo $mainFeedPost["comments_count"]; ?></span>
								</div>
							</div>
						</div>
					</span>
					<span class="content">
						<span class="title"><?php echo $mainFeedPost["title"]; ?></span>
						<span class="heading">
							<span class="name"></span>
							<span class="date"><?php echo $mainFeedPost["date"]; ?></span>
						</span>
						<span class="description"><?php echo $mainFeedPost["description"]; ?></span>
					</span>
				</a>
			</li>
			<?php endwhile; ?>
			<!-- end of the loop -->
			<?php wp_reset_postdata(); ?>
		<?php else:  ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
		</ul>
	</section>
	<!-- /Add content -->
	<!-- /Main feed -->

	<!-- Video list -->
	<?php
		$photoAndVideoID = get_cat_ID('Фото і відео');
		$photoAndVideoLink = get_category_link($photoAndVideoID);
	?>
	<section class="video-list" id="video-list">
		<h3 class="add-title">
			<span>
				<a href="<?php echo $photoAndVideoLink; ?>" style="text-decoration: none;">Фото</a>
				&amp;
				<a href="<?php echo $photoAndVideoLink; ?>" style="text-decoration: none;">Відео</a>
			</span>
		</h3>
		<div class="video-list-holder">
			<ul>
				<?php 
					$args = array('category_name' => 'photovideo','posts_per_page' => 20);
					$the_query = new WP_Query( $args );
				?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php $photoVideoPost = getPhotoAndVideoPostData($post); ?>
					<li><a href="<?php echo $photoVideoPost["url"]; ?>">
						<div class="visual"><img src="<?php echo modImgURL($photoVideoPost["img_url"], 233, 130) ?>" alt=""><span class="btn-play"></span>
						<div class="hover-block"> 
							<div class="block"> 
								<div class="column">
									<span class="ico-view"></span>
									<span class="num"><?php echo $photoVideoPost["views_count"]; ?></span>
								</div> 
								<div class="column">
									<span class="ico-comment"></span>
									<span class="num"><?php echo $photoVideoPost["comments_count"]; ?></span>
								</div>
							</div>
						</div>
						</div>
						<span class="content">
							<?php echo $photoVideoPost["title"]; ?>
							<span class="date"><?php echo $photoVideoPost["date"]; ?></span>
						</span>
					</a></li>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else:  ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>
			</ul>
			<a href="#" class="prev"></a>
			<a href="#" class="next"></a>
		</div>
	</section>
	<!-- /Video list -->
</div>
<!-- /Main content -->
<?php get_footer(); ?>