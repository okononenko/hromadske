<?php get_header(); ?>
<!-- Main content -->
<!-- /Post header -->
<div class="main-content post-container">
	<div class="main-two-columns">
		<!-- Post content -->
		<article class="page-box">
			<h1 class="title"><?php echo get_the_title(); ?></h1>
			<div class="content">
				<?php echo wpautop(get_the_content()); ?>
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
		<!-- /Page content -->
	</div>


	<!-- Help form -->
	<?php $helpPostID = 2948;?>
	<?php if(get_the_ID() == $helpPostID) : ?>
	  <div class="pay-box">
		<ul class="pay-list">
			<li>
				<a href="#" data-tabitem="privatbank">
					<img src="http://img.kgtv.com.ua/str/d37c5125-de63-451c-b5db-e7ec2345c4e1.png" alt="privatbank">
				</a>
			</li>
			<li>
				<a href="#"  data-tabitem="paypal">
					<img src="http://img.kgtv.com.ua/str/5ff7aa35-c63e-4c1b-90bc-9c0431e97d7f.png" alt="paypal">
				</a>
			</li>
			<li>
				<a href="#"  data-tabitem="bank24">
					<img src="http://img.kgtv.com.ua/str/45fdffe9-a03f-4cd9-bcc2-054ce80e89ac.png" alt="bank24">
				</a>
			</li>
		</ul>

		<div class="pay-content" data-tabitem="privatbank">
			<div class="donation-box">
				<h2>privatbank.ua</h2>
				<?php
					function randString(){
					    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					    $randstring = '';
					    for ($i = 0; $i < 20; $i++) {
					        $randstring .= $characters[rand(0, strlen($characters))];
					    }
					    return $randstring;
					}

					$merchantID = "105334";
					$pass = "2T4628KfWB7Er7fJJaNIDee9Tk7Vb7G7";
					$details = "Добровільна пожертва на здійснення статутної діяльності ГО КГТБ";
					$order = randString();
					$extDetails = "1000BDN01";
					$returnURL = "http://kgtv.com.ua/dyakuyemo/";
					$serverURL = "";
				?>
				<form action="https://api.privatbank.ua/p24api/ishop" method="POST" accept-charset="UTF-8" class="donation-form">
					<input type="hidden" name="ccy" value="UAH" />
					<input type="hidden" name="merchant" value="<?= $merchantID ?>" />
					<input type="hidden" name="order" value="<?= $order ?>" />
					<input type="hidden" name="details" value="<?= $details ?>" />
					<input type="hidden" name="ext_details" value="<?= $extDetails ?>" />
					<input type="hidden" name="pay_way" value="privat24" />
					<input type="hidden" name="return_url" value="<?= $returnURL ?>" />
					<input type="hidden" name="server_url" value="<?= $serverURL ?>" />
					<div class="row">
						<div class="text-holder">
							<input type="text" size="4" class="text amount" name="amt" placeholder="Сума для перерахування"/>
						</div>
					</div>
					<div class="row width1">
						<input type="submit" class="submit" value="Продовжити">
					</div>
				</form>
			</div>
		</div>


		<div class="pay-content" data-tabitem="paypal">
			<div class="donation-box">
				<h2 style="line-height: 200px;">функція знаходиться в розробці</h2>
			</div>
		</div>

		<div class="pay-content" data-tabitem="bank24">
			<div class="donation-box" style="width: 565px;">
				<h2>Банк 24</h2>
				<p><iframe width="560" height="315" src="//www.youtube.com/embed/tnt7tmKHFuw" frameborder="0" allowfullscreen></iframe></p>
				<p style="text-align: left">Відтепер в усіх платіжних терміналах Кременчука, розташованих у магазинах «Оптовичок» і «Маркет-Опт», в розділі «Інтернет і телебачення», є кнопка «Кременчуцьке Громадське ТБ». Два-три натискання – і ваша посильна допомога – на рахунку Кременчуцького Громадського.</p>
				<h2>Карта терміналів</h2>
			</div>
			<div id="map-container" style="width: 100%; height: 100%"></div>

			<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
			<script src="http://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.12/gmaps.min.js"></script>
			<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.6.0/underscore-min.js"></script>
			<script>
			$(function(){
				initBank24Map();
			});

			function initBank24Map(){
					var data = [{"title":"БНК","lat":49.0307502746582,"lng":33.44392776489258,"type":2,"address":"м.Кременчук,вул.Республiканська,20"},{"title":"БНК","lat":49.06520462036133,"lng":33.40654754638672,"type":2,"address":"м.Кременчук,вул.Жовтнева,11"},{"title":"БНК","lat":49.09592819213867,"lng":33.435516357421875,"type":2,"address":"м.Кременчук,вул.Толстого,28"},{"title":"БНК","lat":49.134105682373,"lng":33.4418258666992,"type":2,"address":"м.Кременчук,вул.50-рiччя Жовтня,39"},{"title":"БНК","lat":49.1007629677981,"lng":33.4325981140137,"type":2,"address":"м.Кременчук,вул.60 рокiв Жовтня, 81"},{"title":"БНК","lat":49.0657958984375,"lng":33.4100227355957,"type":2,"address":"м.Кременчук,вул.60 рокiв СРСР,3а"},{"title":"БНК","lat":49.14379119873047,"lng":33.43572998046875,"type":2,"address":"м.Кременчук,вул.50 рокiв Жовтня,16"},{"title":"БНК","lat":49.053395260871,"lng":33.2138156890869,"type":2,"address":"м.Свiтловодськ, вул.Ленiна, 50"},{"title":"БНК","lat":49.0799674987793,"lng":33.4238433837891,"type":2,"address":"м.Кременчук, вул.Квартал 101, 10Д"},{"title":"БНК","lat":49.0279350280762,"lng":33.4580459594727,"type":2,"address":"м.Кременчук, вул.Дем’яна Бiдного, 8"},{"title":"БНК","lat":49.021068572998,"lng":33.420539855957,"type":2,"address":"м.Кременчук, вул.Кiровоградська, 57"},{"title":"БНК","lat":49.0095291137695,"lng":33.6294059753418,"type":2,"address":"м.Комсомольськ, вул.Ленiна, 57а"},{"title":"БНК","lat":49.0697593688965,"lng":33.4104957580566,"type":2,"address":"м.Кременчук,вул.Пролетарська,29/35"},{"title":"БНК","lat":49.0660209655762,"lng":33.4113121032715,"type":2,"address":"м.Кременчук,вул.Ленiна,16/9"},{"title":"БНК","lat":49.0405120849609,"lng":33.4283485412598,"type":2,"address":"м.Кременчук,вул.Приходька,44"},{"title":"БНК","lat":49.0623931884766,"lng":33.4175796508789,"type":2,"address":"м.Кременчук, вул.Пролетарська, 3а"},{"title":"БНК","lat":49.1369667053223,"lng":33.4436683654785,"type":2,"address":"м.Кременчук, вул.Сталiнграду, 5"},{"title":"БНК","lat":49.0545764885691,"lng":33.2243728637695,"type":2,"address":"м.Свiтловодськ, вул.Ленiна, 43"},{"title":"БНК","lat":49.0681304733151,"lng":33.4170198440552,"type":2,"address":"м.Кременчук, вул.Ленiна, 32/29"},{"title":"БНК","lat":49.08958053588867,"lng":33.394447326660156,"type":2,"address":"м.Кременчук, вул.Кооперативна, 19"},{"title":"БНК","lat":49.07279586791992,"lng":33.40835189819336,"type":2,"address":"м.Кременчук,вул.Пролетарська,54"},{"title":"БНК","lat":49.02568435668945,"lng":33.456031799316406,"type":2,"address":"м.Кременчук,вул.Республiканська,61а"},{"title":"БНК","lat":49.0106544494629,"lng":33.6352882385254,"type":2,"address":"м.Комсомольськ, вул.Миру, 15"},{"title":"БНК","lat":49.009838104248,"lng":33.6449432373047,"type":2,"address":"м.Комсомольськ, вул.Молодiжна, 6"},{"title":"БНК","lat":49.01112,"lng":33.627541,"type":2,"address":"м.Комсомольськ, вул.Ленiна, 54"},{"title":"БНК","lat":49.0686645507813,"lng":33.40625,"type":2,"address":"м.Кременчук, вул.29 вересня, 11/19"},{"title":"БНК","lat":49.022590637207,"lng":33.4592933654785,"type":2,"address":"м.Кременчук,вул.Республiканська,73"},{"title":"БНК","lat":49.0561514151725,"lng":33.2312822341919,"type":2,"address":"м.Свiтловодськ, вул.Ленiна, 6"},{"title":"БНК","lat":49.0638003489115,"lng":33.4053039550781,"type":2,"address":"м. Кременчук, вул.Ленiна, 3"},{"title":"Отделение","lat":49.06735610961914,"lng":33.413177490234375,"type":0,"address":"м. Кременчук, вул.Леніна, 3"},{"title":"Отделение","lat":49.0592041015625,"lng":33.238929748535156,"type":0,"address":"м. Світловодськ, вул. Леніна, 50"}];
					var kremen = {lat: 49.065783, lng: 33.410033};
					var map = new GMaps({div: '#map-container',lat: kremen.lat,lng: kremen.lng,zoom: 12});
					map.setOptions({scrollwheel: false});
					_.each(data, function(item){
						map.addMarker({
							lat: item.lat,
							lng: item.lng,
							title: item.title,
							infoWindow: {
								content: '<div class="gm-tooltip"><strong>'+item.title+'</strong><div><span class="glyphicon glyphicon-home"></span><strong>  Адрес: </strong>'+item.address+'</div></div>'
							}
						});
					});
				}
				</script>
		</div>
		<script>
			$(function(){
				$(".pay-box .pay-list a").click(function(event){
					event.preventDefault();
					$(".pay-box .pay-content").css({display: "none"});
					var data = $(event.currentTarget).data("tabitem");
					if(data == "bank24") $("#map-container").css({width: "100%", height: "400px"});
					$(".pay-box .pay-content[data-tabitem="+data+"]").css({display: "block"});
				});
			})

		</script>
	  </div>
	 <?php endif; ?>
	<!-- Help form -->

</div>
<!-- /Main content -->
<?php get_footer(); ?>

