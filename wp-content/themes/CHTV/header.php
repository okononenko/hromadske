<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php
		$siteName = "Кременчуцьке Громадське ТБ";
		$title = $siteName;
		if(is_home()) $title = $title;
		if(is_single()) $title = $post -> post_title . " | " . $title;
		if(is_search()) $title = "Результати пошуку | " . $title;
		if(is_category()) $title = single_cat_title('', false) . " | " . $title;
		if(is_page()) $title = get_the_title() . " | " . $title;
	?>
	<title> <?php echo $title; ?> </title>
	<!-- RSS -->
	<?php 
		$rss = "/feed";
		$rssTitle = $siteName;
		if(is_category()){
			$cat = get_query_var('cat');
			$currentCat = get_category ($cat);
			$rss = "/category/" . $currentCat -> slug . $rss;
			$rssTitle = $currentCat -> name . " | " . $rssTitle;
		}
	?>
	<link rel="alternate" type="application/rss+xml" title="<?php echo $rssTitle ?>" href="<?php bloginfo('url'); ?><?php echo $rss; ?>" />
	<!-- /RSS -->

	<!-- Meta -->
	<?php
		$keywords = array(
			"громадське тб",
			"кременчуцьке громадське тб",
			"кременчуг видео",
			"кременчуг громадське тб",
			"кременчуг телеканал",
			"кременчуг",
			"новости кременчуга",
			"кременчук погода",
			"фографии",
			"фото",
			"фотографії кременчука",
			"кременчуцькі новини",
			"кременчуг курс доллара",
			"новини",
			"політика",
			"події",
			"спорт",
			"город кременчуг украина",
			"kremenchug"
		);
		$metaKeywords = arrToCommaSepStr($keywords);
		$metaTitle = "Кременчуцьке Громадське ТБ";
		$metaDescription = "Кременчуцьке Громадське ТБ - спільна ініциатива кременчуцьких журналістів. Новини міста, прямі ефіри та найсвіжіше відео з місця подій.";
		$metaImgURL =  get_template_directory_uri() . "/img/kgtv-logo-big.png";
		$metaURL = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
		if(is_single()){
			$metaTitle = $title;
			$metaDescription = getPostShortDescription($post -> ID);
			$metaImgURL = getPostImgURL($post -> ID);
		}
	?>
	<meta name="title" content="<?php echo $metaTitle; ?>">
	<meta name="description" content="<?php echo $metaDescription; ?>">

	<meta name="robots" content="index, follow">
    <meta name="keywords" content="<?php echo $metaKeywords; ?>">
    <meta name="author" content="Кременчуцьке Громадське ТБ">
    <meta name="document-state" content="state">
    <meta name="revisit-after" content="1 days">
    <meta name="copyright" content="Кременчуцьке Громадське ТБ">
    <meta name="classifications" content="">
    <meta name="other.language" content="ukrainian">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <link rel="image_src" href="<?php echo $metaImgURL; ?>" />

    <meta property="og:title" content="<?php echo $metaTitle; ?>"/>
    <meta property="og:description" content="<?php echo $metaDescription; ?>"/>
    <meta property="og:url" content="<?php echo $metaURL; ?>"/>
    <meta property="og:image" content="<?php echo $metaImgURL; ?>"/>
	<!-- /Meta -->

	<meta name="google-site-verification" content="lzUjcaF4c_g8EQnYWYtnr_mpGNBMDfNx-lBoe9WQb30" />

	<!-- wmail verification -->
	<meta name='wmail-verification' content='1d221add6b8f4194' />
	<!-- wmail verification -->

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon.png" />
	<!-- /Favicon -->
	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,900,700italic,900italic&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
	<!-- /Fonts -->
	<!-- Style -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css?v=3">
	<!-- /Style -->
	<!-- Scripts -->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/logic-view.js"></script>
	<!-- /Scripts -->
</head>
<body>
	<!-- Facebook -->
	<div id="fb-root"></div>
	<script>
	window.fbAsyncInit = function() {
        FB.init({
          appId      : '293110550857506',
          xfbml      : true,
          version    : 'v2.0'
        });
      };
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/uk_UA/sdk.js#xfbml=1&appId=293110550857506&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
	<!-- /Facebook -->

	<!-- VK -->
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?113"></script>
	<script type="text/javascript">
	  VK.init({apiId: 4426597, onlyWidgets: true});
	</script>
	<!-- /VK -->

	<!-- Google Analytics -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-51636715-1', 'kgtv.com.ua');
	  ga('send', 'pageview');
	</script>
	<!-- /Google Analytics -->

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
	(function (d, w, c) {
	    (w[c] = w[c] || []).push(function() {
	        try {
	            w.yaCounter25348760 = new Ya.Metrika({id:25348760,
	                    clickmap:true,
	                    trackLinks:true,
	                    accurateTrackBounce:true});
	        } catch(e) { }
	    });

	    var n = d.getElementsByTagName("script")[0],
	        s = d.createElement("script"),
	        f = function () { n.parentNode.insertBefore(s, n); };
	    s.type = "text/javascript";
	    s.async = true;
	    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

	    if (w.opera == "[object Opera]") {
	        d.addEventListener("DOMContentLoaded", f, false);
	    } else { f(); }
	})(document, window, "yandex_metrika_callbacks");
	</script>
	<!-- /Yandex.Metrika counter -->

	<!-- To show sidebar add sidebar-show to class -->
	<!-- To show videoplayer add to class -->
	<?php
		$mainWrapClasses = " ";
		$cookieSidebarShow = true;
		$cookieVideoplayerShow = true;

		if(isset($_COOKIE["sidebar-show"])){
			if($_COOKIE["sidebar-show"] == "true") $cookieSidebarShow = true;
			else $cookieSidebarShow = false;
		}
		if(isset($_COOKIE["videoplayer-show"])){
			if($_COOKIE["videoplayer-show"] == "true") $cookieVideoplayerShow = true;
			else $cookieVideoplayerShow = false;
		}

		if($cookieSidebarShow) $mainWrapClasses .= " sidebar-show";
		if(is_home() && $cookieVideoplayerShow) $mainWrapClasses .= " videoplayer-show";
	?>
	<div class="wrap <?php echo $mainWrapClasses; ?>">
		<!-- Sidebar open btn -->
		<span class="sidebar-btn-open-holder">
			<a href="#" id="btn-open-menu"></a>
		</span>
		<!-- /Sidebar open btn -->
		<!-- Sidebar -->
		<aside class="sidebar">
			<div class="sidebar-holder">
				<div class="sidebar-wrap">
				
					<a href="#" class="icon-close" id="btn-close-menu"></a>
					<a href="#" class="login">
						<span class="item-text">Вхід</span>
					</a>
					<form role="search" class="search-form" action="<?php echo home_url(); ?>" method="get">
						<fieldset>
							<input type="submit" class="submit" value="search" >
							<input id="s" name="s" type="text" class="text" placeholder="Пошук">
						</fieldset>
					</form>
					<menu class="nav">
					<!-- Set li.active to higlight item -->
					<?php
						$menu = 'Головне меню';
						$args = array();
						$items = wp_get_nav_menu_items($menu, $args);
						$items = convertMenu($items);
						// print_r($items);
						for($i = 0; $i < count($items); $i++){
							$item = $items[$i];
							echo '<li>';
							echo '<a href="'.$item["url"].'">'.$item["title"].'</a>';
							if(isset($item["submenu"])){
								$submenuItems = $item["submenu"];
								echo '<ul class="drop submenu">';
								for($j = 0; $j < count($submenuItems); $j++){
									$subitem = $submenuItems[$j];
									echo '<li>';
									echo '<a href="'.$subitem["url"].'">'.$subitem["title"].'</a>';
									echo '</li>';
								}
								echo '</ul>';
							}
							echo '</li>';
						}
					?>
					</menu>
				</div>
			</div>
		</aside>
		<!-- /Sidebar -->
		<!-- Main -->
		<div class="main">
			<header class="header">
				<div class="logo">
					<a href="<?php echo home_url(); ?>"></a>
				</div>
				<div class="inform">
					<div>
						<?php 
							$w = getWeather();
							$temperatureVal = floatval($w -> t);
							if($temperatureVal > 0) $temperature = "+".number_format($temperatureVal, 0);
							else $temperature = number_format($temperatureVal, 0);
							$weatherState = $w -> desc;
						?>
						<span class="weather num <?php echo $weatherState ?>"><?php echo $temperature ?> °</span>
						<span class="status">Кременчук</span>
					</div>
					<div>
						<span class="rate num"><?php echo getCurrency(); ?></span>
						<span class="status">USD</span>
					</div>
				</div>
				<ul class="social">
					<li><a class="facebook" href="https://www.facebook.com/kgtv.kremenchug" target="_blank"></a></li>
					<li><a class="twitter" href="https://twitter.com/KremenTV" target="_blank"></a></li>
					<li><a class="google" href="https://plus.google.com/u/0/112215389136835926605/posts" target="_blank"></a></li>
					<li><a class="vk" href="http://vk.com/kgtv.kremen" target="_blank"></a></li>
					<li><a class="youtube" href="https://www.youtube.com/user/kremenchuktv" target="_blank"></a></li>
					<li><a class="rss" href="<?php bloginfo('rss2_url'); ?>" target="_blank"></a></li>
					<li><a class="email" href="#" target="_blank"></a></li>
				</ul>
				<a href="/help" class="btn-help"><span>+</span> Допомогти проекту</a>
			</header>
			<?php 
				$broadcast = getCurrentBroadcastVideo();
				$broadcastTitle = $broadcast -> title;
				$broadcastID = $broadcast -> id;
				$broadcastState = $broadcast -> status;
				$broadcastStartTime = $broadcast -> start;
				$broadcastStartTimeStr = broadcastStartTimeToStr($broadcastStartTime);
				$broadcastStarted = ((new DateTime($broadcastStartTime)) -> getTimestamp()) < ((new DateTime()) -> getTimestamp());
			?>
			<div class="playlist">
				<div class="program">
					<div class="block">
						<a class="btn-opener" href="#">
							ДИВИТИСЬ Громадське ONLINE 
							<span class="icon icon-close"></span>
						</a>
					</div>
				</div>
				<ul class="playlist-menu">
<!-- 					<li>
						<a href="#">
							<span class="icon rss"></span>
							<span class="name">слухай<br/>ефір</span>
						</a>
					</li> -->
					<?php if ( $broadcast ) : ?>
					<li>
						<a target="_blank" href="https://www.youtube.com/watch?v=<?php echo $broadcastID; ?>">
							<span class="icon comments"></span>
							<span class="name">Обговорюй<br/>ефір</span>
						</a>
					</li>
<!-- 					<li>
						<a href="/vote/">
							<span class="icon graph"></span>
							<span class="name" style="top: -14px">Голосування</span>
						</a>
					</li>
					<li>
						<a href="/debate/">
							<span class="icon debate"></span>
							<span class="name" style="top: -14px">Дебати</span>
						</a>
					</li> -->
					<?php endif; ?>
				</ul>
				<div class="video">
					<div class="video-holder" id="video-holder">
						
					</div>
					<ul class="video-play-list">
						<?php if ( $broadcast ) : ?>
						<li class="active" >
							<a href="#" id="video-play-list-broadcast" data-video-id="<?php echo $broadcastID; ?>" data-video-autoplay="true">
								<span class="time telecast-time">
									<span></span>
								</span>
								<span class="item-name telecast-description">
									<?php echo $broadcastTitle; ?>
								</span>
							</a>
						</li>
						<?php endif; ?>
						<?php 
							$args = array('category_name' => 'videoplayer', 'posts_per_page' => 5);
							$the_query = new WP_Query( $args );
						?>
						<?php if ( $the_query->have_posts() ) : ?>
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<?php $video = get_post_meta( $post -> ID, "post_video", true); if(!$video) $video = defaultVideo(); ?>
							<!-- the loop -->
							<li>
								<a href="#" data-video="<?php echo $video ?>">
									<span class="time telecast-time">
										<span></span>
									</span>
									<span class="item-name telecast-description">
										<?php the_title(); ?>
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
				</div>
			</div>