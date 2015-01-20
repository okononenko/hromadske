$.fn.bigSlider = function() {
    var prev = $(".prev", this);
    var next = $(".next", this);
    $(prev).click(prevClicked);
    $(next).click(nextCliked);

    var self = this;

    function prevClicked(event){
    	event.preventDefault();
    	var a = $(".active", self);
    	var n = !a.is(":first-child") ? a.prev() : $("li", self).last();
    	change(a, n);
    }

    function nextCliked(event){
    	event.preventDefault();
    	var a = $(".active", self);
    	var n = !a.is(":last-child") ? a.next() : $("li", self).first();
    	change(a, n);
    }

    function change(fromEl, toEl){
    	$(fromEl).css({display: "block", opacity: 1});
    	$(toEl).css({display: "block", opacity: 0});
    	$("li", self).removeClass("active");
    	$(fromEl).animate({opacity: 0}, 500);
    	$(toEl).animate({opacity: 1}, 500, function(){
    		$(toEl).addClass("active");
    	});
    }

    return this;
}

$.fn.scrollGallery = function(opt){
    var prev = $(".prev", this);
    var next = $(".next", this);
    var ul = $("ul", this);
    var step = $("li", this).width();

    if(!opt) opt = {};
    var scrollStep = 4;
    if(opt.scrollStep) scrollStep = parseInt(opt.scrollStep);

    $(prev).click(prevClicked);
    $(next).click(nextCliked);

    function nextCliked(event){
        event.preventDefault();
        
        var current = ul.scrollLeft();
        var pos = current + (step * scrollStep);
        scrollToPos(pos);
    }

    function prevClicked(event){
        event.preventDefault();
        
        var current = ul.scrollLeft();
        var pos = current - (step * scrollStep);
        if(pos < 0) pos = 0;
        scrollToPos(pos);
    }

    function scrollToPos(pos){
        ul.animate({scrollLeft: pos}, 300);
    }
}

$(function(){
	$(".btn-opener").click(btnOpenerClicked);
	$("#btn-open-menu").click(openMenuButtonClicked);
	$("#btn-close-menu").click(closeMenuButtonClicked);

	$("#main-galery").bigSlider();
	$("#scroll-gallery").scrollGallery({scrollStep: 2});
	$("#video-list").scrollGallery();

    $(".video .video-play-list a").click(videoplayerLinkClicked);

    initYoutubePlayerAPI();
})

function btnOpenerClicked(event){
    event.preventDefault();
	$(".wrap").toggleClass("videoplayer-show");
    if($(".wrap").hasClass("videoplayer-show")){
        setCookie("videoplayer-show", "true", 365);
        createBroadcastPlayer();
    }else{
        setCookie("videoplayer-show", "false", 365);
        removeBroadcastPlayer();
    }
}

function openMenuButtonClicked(event){
    event.preventDefault();
	$("body .wrap").addClass("sidebar-show");
    setCookie("sidebar-show", "true", 365);
}

function closeMenuButtonClicked(event){
    event.preventDefault();
	$("body .wrap").removeClass("sidebar-show");
    setCookie("sidebar-show", "false", 365);
}

/*============ Broadcast player ============*/

function createBroadcastPlayer(){
    var el = $("#video-play-list-broadcast");
    if(el){
        var videoID = $(el).data("video-id");
        if(videoID){
            var autoplayStr = $(el).data("video-autoplay");
            console.log(autoplayStr);
            var autoplay = autoplayStr ? true : false;
            playVideoWithID(videoID, autoplay);
        }
    }
}

function initBroadcastPlayer(){
    if(!curretBroadcastData) return;
}

function removeBroadcastPlayer(){
    if(videoPlayer) videoPlayer.stopVideo();
}

function isBroadcastPlayerShowed(){
    return $(".wrap").hasClass("videoplayer-show");
}

/*============ Videoplayer ============*/

var videoPlayer;

function playVideoWithID(videoId, autoplay){
    console.log("playing video with id: " + videoId);
    if(autoplay) console.log("autoplay: true");
    else console.log("autoplay: false");

    if(!videoPlayer){
        videoPlayer = new YT.Player('video-holder', {
            height: '706',
            width: '499',
            videoId: videoId,
            events: {
                'onReady': function(event){
                    if(videoPlayer.autoplay) event.target.playVideo();
                    else videoPlayer.stopVideo();
                }
            }
        });
        videoPlayer.autoplay = autoplay;
    }else{
        videoPlayer.autoplay = autoplay;
        if(autoplay) videoPlayer.loadVideoById(videoId);
        else videoPlayer.cueVideoById(videoId);
    }
}


function videoplayerLinkClicked(event){
    event.preventDefault();

    var videoID = $(this).data("video-id");
    if(!videoID){
        var videoLink = $(this).data("video");
        if(videoLink) videoID = youtubeVideoID(videoLink);
    }
    if(!videoID) return;
    var autoplayStr = $(this).data("video-autoplay");
    var autoplay = autoplayStr && (autoplayStr == true) ? true : false;
    playVideoWithID(videoID, autoplay);

    makeVideoPlayListElementActive($(this).parent());
}

function makeVideoPlayListElementActive(el){
    $(".video .video-play-list li").removeClass("active");
    $(el).addClass("active");
}

/*============ Youtube ============*/

function initYoutubePlayerAPI(){
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}

function onYouTubeIframeAPIReady() {
    if(isBroadcastPlayerShowed()){
        createBroadcastPlayer();
    }
}

function youtubeVideoID(link){
    var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
    return (link.match(p)) ? RegExp.$1 : false;
}

/*============ Cookies ============*/

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i].trim();
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toGMTString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

