<!-- Comments block -->
<seaction class="comments-block">
	<header class="comments-heading">
		<h2 class="add-title">
			<span>
				КОМЕНТАРІ:
				<em class="counter comments-count-holder"><?php echo getPostCommentsCount($post -> ID); ?></em>
			</span>
		</h2>
	</header>
	<div class="comments-wrap">
		<div id="disqus_thread"></div>
	    <script type="text/javascript">
	        var disqus_shortname = 'kgtv';
	        var disqus_identifier = '<?php echo $post -> ID; ?>';
	        (function() {
	            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
	            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
	            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	        })();

	        function disqus_config() {
			    this.callbacks.onNewComment = [function(comment){
			    	incCommentsCount();
			    	sendUpdateCommentsCountRequest();
			    }];
			}

			function incCommentsCount(){
				var val = getOnPageCommentsCount();
				val++;
				setOnPageCommentsCount(val);
			}

			function setOnPageCommentsCount(commentsCount){
				$(".comments-count-holder").text(commentsCount);
			}

			function getOnPageCommentsCount(){
				var text = $(".comments-count-holder").first().text();
				var val = parseInt(text);
				return val;
			}

			function sendUpdateCommentsCountRequest(){
				setTimeout(function(){
					var postID = '<?php echo $post -> ID; ?>';
			    	updateCommentsCount(postID, function(err, commentsCount){
			    		if(err) return console.log("err: " + JSON.stringify(err));
			    		console.log("comments count updated, current: " + commentsCount);
			    	});
				}, 2000);
			}

			function updateCommentsCount(postID, callback){
				var url = '<?php echo get_template_directory_uri(); ?>/commentscount.update.php?id=' + postID;
				$.ajax({
				  url: url,
				  data: {id: postID}
				}).done(function(data){
					if(data.error) return callback(data.error);
					callback(null, data.result.count);
				}).fail(function(err){
					callback(err);
				});
			}
	    </script>
	    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
	</div>
</seaction>
<!-- /Comments block -->