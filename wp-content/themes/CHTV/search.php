<?php get_header(); ?>
<!-- Main content -->
<!-- Post header -->
<?php
	global $query_string;

	$query_args = explode("&", $query_string);
	$search_query = array();

	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	} // foreach

	$search = new WP_Query($search_query);
?>
<form class="big-search-form" method="get" role="search" action="<?php echo home_url(); ?>">
	<fieldset>
		<div class="search-btn">
			<input type="submit" class="submit" value="   Шукати" >
		</div>
		<div class="area">
			<?php 
				$searchPhrace = "";
				if(isset($_GET["s"])) $searchPhrace = $_GET["s"];
			?>
			<input id="s" name="s" type="text" class="text" value="<?php echo $searchPhrace; ?>" placeholder="Введіть слова для пошуку">
		</div>
	</fieldset>
</form>
<!-- <header class="main-heading">
	<h1 class="title">some</h1>
</header> -->
<!-- /Post header -->
<div class="main-content post-container">
	<div class="main-two-columns">
		<!-- Sidebar -->
		<?php get_sidebar(); ?>
		<!-- /Sidebar -->
		<!-- Post content -->
		<section class="wide-main-column">
			<div class="news-block">
				<ul class="news-list">
					<?php if ( $search->have_posts() ) : ?>
					<?php while ( $search->have_posts() ) : $search->the_post(); ?>
					<?php $categoryPost = getCategoryPostData($post); ?>
					<li>
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
		<!-- /Post content -->
	</div>
	<?php get_template_part("headlines"); ?>
</div>
<!-- /Main content -->
<?php get_footer(); ?>