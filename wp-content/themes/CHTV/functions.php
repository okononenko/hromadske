<?php

define("sec", 1);
define("min", sec * 60);
define("hour", min * 60);
define("half_of_day", hour * 12);
define("day", hour * 24);
define("two_days", day * 2);
define("week", day * 7);

/*============ Menu ============*/

function register_menu() {
  register_nav_menu('side-menu',__( 'Головне меню' ));
}

add_action( 'init', 'register_menu' );

/*============ Headlines ============*/

function get_headlines(){
	include("headlines.php");
}

function getHeadlinesPostData($post){
	return array(
		"img_url" => getPostImgURL($post -> ID),
		"views_count" => getPostViewsCount($post -> ID),
		"comments_count" => getPostCommentsCount($post -> ID),
		"url" => getPostURL($post -> ID),
		"title" => $post -> post_title,
		"date" => headlinePostDate($post),
		"description" => getPostShortDescription($post -> ID)
	);
}

/*============ Main content ============*/

function getMainContentPostData($post){
	return array(
		"img_url" => getPostImgURL($post -> ID),
		"url" => getPostURL($post -> ID),
		"title" => $post -> post_title
	);
}

/*============ Newsline ============*/

function getNewslinePostData($post){
	return array(
		"url" => getPostURL($post -> ID),
		"title" => $post -> post_title,
		"date" => newslinePostDate($post),
		"sticker" => getPostSticker($post -> ID)
	);
}

function getPostSticker($postID){
	$sticker = get_post_meta($postID, "sticker", true);
	if(!$sticker) return null;
	if($sticker == "") return null;
	if($sticker == "none") return null;
	return $sticker;
}

/*============ Main feed ============*/

function getMainFeedPostData($post){
	$arr = array(
		"img_url" => getPostImgURL($post -> ID),
		"views_count" => getPostViewsCount($post -> ID),
		"comments_count" => getPostCommentsCount($post -> ID),
		"url" => getPostURL($post -> ID),
		"title" => $post -> post_title,
		"date" => headlinePostDate($post),
		"description" => getPostShortDescription($post -> ID),
		"category" => getPostCategory($post -> ID) 
	);
	$arr["category_color"] = categoryToCategoryCollor($arr["category"]);
	return $arr;
}

function categoryToCategoryCollor($category){
	if($category == "Спорт") return "orange";
	if($category == "Економіка") return "red";
	if($category == "Кримінал") return "black";
	if($category == "Культура") return "blue";
	if($category == "Політика") return "green";
	if($category == "Суспільство") return "lime";
	if($category == "Новини") return "blue";
	return "blue";
}

/*============ Photo & Video ============*/

function getPhotoAndVideoPostData($post){
	return array(
		"img_url" => getPostImgURL($post -> ID),
		"views_count" => getPostViewsCount($post -> ID),
		"comments_count" => getPostCommentsCount($post -> ID),
		"url" => getPostURL($post -> ID),
		"title" => $post -> post_title,
		"date" => headlinePostDate($post),
		"description" => getPostShortDescription($post -> ID)
	);
}

/*============ Comments ============*/

function get_comments_block(){
	include("comments.php");
}

/*============ Category ============*/

function getCategoryPostData($post){
	return array(
		"img_url" => getPostImgURL($post -> ID),
		"views_count" => getPostViewsCount($post -> ID),
		"comments_count" => getPostCommentsCount($post -> ID),
		"url" => getPostURL($post -> ID),
		"title" => $post -> post_title,
		"date" => categoryPostDate($post),
		"description" => getPostShortDescription($post -> ID),
		"sticker" => getPostSticker($post -> ID)
	);
}

/*============ Site data ============*/

function getWeather(){
	$url = "http://tools.kgtv.com.ua/api/v1/weather.get";
	$data = getJSON($url);
	if(!isset($data -> result)) return nil;
	if(!isset($data -> result -> t)) return nil;
	if(!isset($data -> result -> desc)) return nil;
	$data -> result -> desc = weatherStateToClass($data -> result -> desc);
	return $data -> result;
}

function getCurrency(){
	$url = "http://tools.kgtv.com.ua/api/v1/currency.get";
	$data = getJSON($url);
	if(!isset($data -> result)) return nil;
	if(!isset($data -> result -> USD)) return nil;
	$val = floatval($data -> result -> USD);
	return number_format($val, 2);
}

function getCurrentBroadcastVideo(){
	$url = "http://tools.kgtv.com.ua/api/v1/broadcast.current";
	$data = getJSON($url);
	if(!isset($data -> result)) return nil;
	return $data -> result;
}

function broadcastStartTimeToStr($dateStr){
	$date = new DateTime($dateStr);
	return $date->format('H:i');
}

function weatherStateToClass($weatherState){
	if($weatherState == "mostly cloudy") return "mostly-cloudy";
	return $weatherState;
}

function getJSON($url){
	$str = file_get_contents($url);
	return json_decode($str);
}

/*============ Tools api functions ============*/

function toolsApiRequest($method, $params = null){
	$url = "http://tools.kgtv.com.ua/api/v1/".$method;
	if($params){
		$i = 0;
		foreach ($params as $key => $value) {
			if($i == 0) $url .= "?".$key."=".$value;
			else $url .= "&".$key."=".$value;
			$i++;
		}
	}
	$data = getJSON($url);
	if(!$data) return null;
	if(isset($data -> error)) return null;
	if(!isset($data -> result)) return null;
	return $data -> result;
}

/*============ Template functions ============*/

function modImgURL($src, $width = 0, $height = 0){
	$url = "http://img.kgtv.com.ua/mod?src=".$src;
	if(isset($width) && isset($height)) return $url."&w=".$width."&h=".$height;
	if(isset($width) && ($width != 0)) return $url."&w=".$width;
	if(isset($height) && ($height != 0)) return $url."&h=".$height;
	return "";
}

function isHaveCategory($categories, $name){
	for($i = 0; $i < count($categories); $i++){
		if($categories[$i] -> name == $name) return true;
	}
	return false;
}

function defaultVideo(){
	return "https://www.youtube.com/watch?v=TQY8FYMrH_E";
}



function postVideoCodeFromURL($url, $w = 630, $h = 354){
	$videoID = youtubeVideoIDFromURL($url);
	$url = "http://www.youtube.com/embed/".$videoID;
	return '<iframe width="'.$w.'" height="'.$h.'" src="'.$url.'" frameborder="0" allowfullscreen></iframe>';
}

function youtubeVideoIDFromURL($url){
	$matches;
	preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
	if(isset($matches[0])) return $matches[0];
	else return "";
}

function postImgURL($post, $width = 0, $height = 0){
	$id = $post -> ID;
	$postImg = get_post_meta($id, "post_img", true);
	if(!$postImg) $postImg = defaultImgURL();
	return modImgURL($postImg, $width, $height);
}

/*============ Dates ============*/

function newslinePostDate($post){
	$date = new DateTime($post -> post_date);
	$days = daysFromNow($date);
	if($days == 0) return $date->format('H:i');
	if($days == 1) return $date->format('Вчора, H:i');
	return $date->format('d.m.y, H:i');
}

function categoryPostDate($post){
	return postDateToDateWithMothStr($post);
}

function sidebarPostDate($post){
	return postDateToDateWithMothStr($post);
}

function headlinePostDate($post){
	return postDateToDateWithMothStr($post);
}

function singlePostDate($post){
	$date = new DateTime($post -> post_date);
	$monthName = dateToMonthName($date);
	$weekDayName = dateToWeekDayName($date);
	return $date->format($weekDayName . ', j ' . $monthName . ' Y');
}

function postDateToStr($postDate){
	$date = new DateTime($postDate);
	$days = daysFromNow($date);
	if($days == 0) return $date->format('H:i');
	if($days == 1) return $date->format('Вчора, H:i');
	return $date->format('m.d.y, H:i');
}

// 18 червня, 22:16								
function postDateToDateWithMothStr($post){
	$date = new DateTime($post -> post_date);
	$days = daysFromNow($date);
	if($days == 0) return $date->format('Сьогодн, H:i');
	if($days == 1) return $date->format('Вчора, H:i');
	$monthName = dateToMonthName($date);
	return $date->format('j '.$monthName.', H:i');
}

function dateToMonthName($date){
	$month = intval($date->format("m"));
	if($month == 1) return "січня";
	if($month == 2) return "лютого";
	if($month == 3) return "березня";
	if($month == 4) return "квітня";
	if($month == 5) return "травня";
	if($month == 6) return "червня";
	if($month == 7) return "липня";
	if($month == 8) return "серпня";
	if($month == 9) return "вересеня";
	if($month == 10) return "жовтня";
	if($month == 11) return "листопада";
	if($month == 12) return "грудня";
	return "";
}

function dateToWeekDayName($date){
	$d = intval($date->format("w"));
	if($d == 1) return "Понеділок";
	if($d == 2) return "Вівторок";
	if($d == 3) return "Середа";
	if($d == 4) return "Четвер";
	if($d == 5) return "П'ятниця";
	if($d == 6) return "Субота";
	if($d == 0) return "Неділя";
	return "";
}

function daysFromNow($date){
	$now = new DateTime();
	$dayAgo = (new DateTime()) -> setTimestamp($now -> getTimestamp() - (24 * 60 * 60));
	$twoDaysAgo = (new DateTime()) -> setTimestamp($dayAgo -> getTimestamp() - (24 * 60 * 60));

	if($now->format('d.m.y') == $date->format('d.m.y')) return 0;
	if($dayAgo->format('d.m.y') == $date->format('d.m.y')) return 1;
	if($twoDaysAgo->format('d.m.y') == $date->format('d.m.y')) return 2;
    $datediff = $now -> getTimestamp() - $date -> getTimestamp();
    return floor($datediff/(60*60*24));
}

function clearFromTags($text){
	return clearWithPattern("/\<[\s\S]+?\>/i", $text);
}

function clearFromInvisibleSymbols($text){
	$text = clearWithPattern("/\r\n+/i", $text);
	$text = clearWithPattern("/\n+/i", $text);
	$text = clearWithPattern("/\t+/i", $text);
	return $text;
}

function clearWithPattern($text, $pattern){
	return str_replace($pattern, "", $text);
}

/*============ Post info ============*/

function getPostURL($id){
	return get_permalink($id);
}

function getPostShortDescription($id){
	$postDesc = get_post_meta($id, "description", true);
	if($postDesc) return $postDesc;
	return "";
}

function getPostCategory($id){
	$categories = wp_get_post_categories($id);
	foreach ($categories as $c) {
		//TODO: сделать список разделов, которые нужно исключать
		if($c == 1) continue;
		if($c == 10) continue;
		if($c == 11) continue;
		if($c == 12) continue;
		if($c == 15) continue;
		if($c == 16) continue;
		if($c == 18) continue;
		if($c == 19) continue;
		$cat = get_category($c);
		return $cat -> name;
	}
	return "без категорії";
}

function getPostEditLink($id){
	$baseURL = get_site_url();
	return $baseURL."/wp-admin/post.php?post=".$id."&action=edit";
}


function getPostCommentsCount($id){
	$data = toolsApiRequest("news.post.commentscount", array('id' => $id));
	if(!$data) return 0;
	if(!isset($data -> count)) return 0;
	return $data -> count;
}

function getPostImgURL($id){
	$img = get_post_meta( $id, "post_img", true); 
	if($img) return $img;
	$videoURL = get_post_meta( $id, "post_video", true);
	if($videoURL){
		$videoID = youtubeVideoIDFromURL($videoURL);
		if(!$videoID) $videoID = $videoURL;
		return youtubeVideoIDToImgURL($videoID);
	}
	return defaultImgURL();
}

function defaultImgURL(){
	return "http://img.kgtv.com.ua/str/g1bVEgmjJe.png";
}


function youtubeVideoIDToImgURL($videoID){
	return "http://img.youtube.com/vi/".$videoID."/maxresdefault.jpg";
}

/*============ Views ============*/

function increaseViewsCount($id){
	toolsApiRequest("news.post.viewscount.inc", array('id' => $id));
}

function getPostViewsCount($id){
	$data = toolsApiRequest("news.post.viewscount", array('id' => $id));
	if(!$data) return 0;
	if(!isset($data -> count)) return 0;
	return $data -> count;
}

/*============ Sidebar ============*/

function getSidebarPostData($post){
	return array(
		"img_url" => getPostImgURL($post -> ID),
		"views_count" => getPostViewsCount($post -> ID),
		"comments_count" => getPostCommentsCount($post -> ID),
		"url" => getPostURL($post -> ID),
		"title" => $post -> post_title,
		"date" => sidebarPostDate($post),
		"category" => getPostCategory($post -> ID)
	);
}

/*============ Menu ============*/

function convertMenu($menu){
	$newMenu = array();
	for($i = 0; $i < count($menu); $i++){
		$item = $menu[$i];

		$menuItem = array();
		$menuItem["ID"] = $item -> ID;
		$menuItem["title"] = $item -> title;
		$menuItem["url"] = $item -> url;
		$menuParentItem = $item -> menu_item_parent;

		if($menuParentItem == 0){
			$newMenu[] = $menuItem;
		}else{
			for($j = 0; $j < count($newMenu); $j++){
				if($newMenu[$j]["ID"] == $menuParentItem){
					if(!isset($newMenu[$j]["submenu"])) $newMenu[$j]["submenu"] = array();
					$newMenu[$j]["submenu"][] = $menuItem;
				}
			}
		}
	}
	return $newMenu;
}

/*============ Functions ============*/

function arrToCommaSepStr($arr){
	$str;
	for($i = 0; $i < count($arr); $i++){
		if($i == 0) $str = $arr[$i];
		else $str .= ", " . $arr[$i];
	}
	return $str;
}

?>