<!-- Headlines -->
<div class="headlines">
	<h3 class="add-title">
		<span>Головна шпальта</span>
	</h3>
	<!-- Headlines content -->
	<section class="add-content">
		<ul>
		<?php 
			$args = array(
				'category_name' => 'main', 
				'posts_per_page' => 4
			);
			$the_query = new WP_Query($args);
		?>
		<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php $headlinePost = getHeadlinesPostData($post);  ?>
			
				<li>
					<a href="<?php echo $headlinePost["url"]; ?>">
						<span class="visual">
							<img src="<?php echo modImgURL($headlinePost["img_url"], 230, 146); ?>">
							<div class="hover-block"> 
								<div class="block"> 
									<div class="column">
										<span class="ico-view"></span>
										<span class="num"><?php echo $headlinePost["views_count"]; ?></span>
									</div> 
									<div class="column">
										<span class="ico-comment"></span>
										<span class="num"><?php echo $headlinePost["comments_count"]; ?></span>
									</div>
								</div>
							</div>
						</span>
						<span class="content">
							<span class="title"><?php echo $headlinePost["title"]; ?></span>
							<span class="heading">
								<span class="name"></span>
								<span class="date"><?php echo $headlinePost["date"]; ?></span>
							</span>
							<span class="description"><?php echo $headlinePost["description"]; ?></span>
						</span>
					</a>
				</li>

			<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
		<?php else:  ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
		</ul>
	</section>
	<!-- /Headlines content -->
</div>
<!-- /Headlines -->