<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114376129-1"></script>
<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	   gtag('config', 'UA-114366047-1',{
       'custom_map': {
        'dimension1': 'pageType' ,
        'dimension2': 'clientId',
       }
    });

	  gtag('event', 'page_name', {'pageType': 'product'});

	  setTimeout(function(){ gtag('event', location.pathname, { 'event_category': 'Новый посетитель' }); }, 15000);
	</script>
	<script>
		setTimeout(function(){
		gtag('event', location.pathname, {
		  'event_category': 'Новый посетитель'
		});
		}, 15000);
	</script>

<meta charset="UTF-8">
	<link rel="stylesheet" href="styles/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
	<script src="js/jquery-3.3.1.min.js"></script>
	<title>Bouquet Shop</title>
</head>
<body>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
	    (function (d, w, c) {
	        (w[c] = w[c] || []).push(function() {
	            try {
	                w.yaCounter48000773 = new Ya.Metrika({
	                    id:48000773,
	                    clickmap:true,
	                    trackLinks:true,
	                    accurateTrackBounce:true,
	                    webvisor:true,
	                    ecommerce:"dataLayer"
	                });
	            } catch(e) { }
	        });

	        var n = d.getElementsByTagName("script")[0],
	            s = d.createElement("script"),
	            f = function () { n.parentNode.insertBefore(s, n); };
	        s.type = "text/javascript";
	        s.async = true;
	        s.src = "https://mc.yandex.ru/metrika/watch.js";

	        if (w.opera == "[object Opera]") {
	            d.addEventListener("DOMContentLoaded", f, false);
	        } else { f(); }
	    })(document, window, "yandex_metrika_callbacks");
	</script>
<noscript><div><img src="https://mc.yandex.ru/watch/48000773" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<header>
		<div class="logo"><a href="index.php">Bouquet Shop</a></div>
		<div class="basket"> 
			<a href="<?php if(isset($_SESSION['products']) && array_sum($_SESSION['products']) != 0) echo 'basket.php'; else echo 'basket1.php'; ?>"> <span id="card_count">(<?php if(isset($_SESSION['products'])) 
			echo array_sum($_SESSION['products']); 
			else echo '0';?>) 
			</span> Корзина</a> 
		</div>
	</header>

	<main>
		<div class="nav">
			<ul>
				<a href="goods.php?id=1"><li class="jacket">Съедобные</a></li>
				<hr>
				<li class="jeans"><a href="goods.php?id=2">Цветочные</a></li>
				<hr>
			</ul>
		</div>
		<div id="container">
			<div style="margin:20px auto; text-align: center;">
				<form action="search.php" method="GET"> 
					<input type="text" name="s" id="search_box" class='search_box'/> 
					<input type="submit" value="Поиск" class="search_button" /><br /> 
				</form>
			</div>
		<div>
		<div class="goods">
			<?php
			require ('bd.php');
			$id = $_GET['id'];
			$goods = $mysqli->query("SELECT * FROM goods WHERE id = $id");
			while($result = mysqli_fetch_assoc($goods)) {
				echo '<h1>'.$result['name'].'</h1>
				<div class="product_solo">
				<img src="images/goods/'.$result['img'].'.jpg" alt="" class="img_product">
				<h2>Описание товара</h2>
				<p>
			Бесспорно, самой прекрасной и очаровательной половиной человечества являются женщины. Они, как богини достойны только самых лучших даров. Если вы хотите выбрать незабываемый подарок для вашей любимой, очень важно помнить о нескольких простых вещах: букет цветов для любимой должен выражать ваши искренние чувства и дать ей возможность почувствовать свою значимость для вас. Какой же купить букет цветов для любимой?
				</p>
				<span>'.$result['price'].' руб.</span>
				<button onclick="add_to_card('.$result['id'].'); gtag(\'event\', \'Click\', { \'event_category\': \'Button\', \'event_label\': \'card_in_basket\' }); 
					yaCounter48000773.reachGoal(\'CARD_IN_BASKET\');
									gtag(\'event\', \'add_to_cart\', {
									  \'items\': [
										{
										  \'id\': \''.$result['id'].'\',
										  \'name\': \''.$result['name'].'\',
										  \'category\': \''.$result['id_category'].'\',
										  \'price\': \''.$result['price'].'\'
										}
									  ]
									});
									dataLayer.push({
										\'ecommerce\': {
											\'add\': {
												\'products\': [
												{
													\'id\': \''.$result_other_goods['id'].'\',
													\'name\': \''.$result_other_goods['name'].'\',
													\'price\': \''.$result_other_goods['price'].'\',
													\'category\': \''.$result_other_goods['id_category'].'\',
												}
												]
											}
											}
											});">В корзину</button>
				</div>';
			} ?>				
		</div>
		<div class="others">
			<h2>Вам может понравится</h2>
			<div class="others_product">
				<?php
				$other_goods = $mysqli->query("SELECT * FROM goods limit 3");
				while ($result_other_goods = mysqli_fetch_assoc($other_goods)) {
					echo '<div class="product_solo" style="display: inline-block; width: 300px;">
					<a href="product.php?id'.$result_other_goods['id'].'" onclick="gtag(\'event\', \'select_content\', {
                                                                       \'content_type\': \'product\',
                                                                       \'items\': [
                                                                           {
                                                                               \'id\': \''.$result_other_goods['id'].'\',
                                                                               \'name\': \''.$result_other_goods['name'].'\',
                                                                               \'category\': \''.$result_other_goods['id_category'].'\',
                                                                               \'price\': \''.$result_other_goods['price'].'\'
                                                                           }]});"><img src="images/goods/'.$result_other_goods['img'].'.jpg" alt="" width="150px"></a>
																		   <p>'.$result_other_goods['name'].'</p>
																		   <p>'.$result_other_goods['price'].' руб</p>
																		   <button onclick="add_to_card('.$result['id'].'); gtag(\'event\', \'Click\', { \'event_category\': \'Button\', \'event_label\': \'card_in_basket\' }); 
					yaCounter48000773.reachGoal(\'CARD_IN_BASKET\');
																				gtag(\'event\', \'add_to_cart\', {
																				  \'items\': [
																					{
																					  \'id\': \''.$result_other_goods['id'].'\',
																					  \'name\': \''.$result_other_goods['name'].'\',
																					  \'category\': \''.$result_other_goods['id_category'].'\',
																					  \'price\': \''.$result_other_goods['price'].'\'
																					}
																				  ]
																				});
																				dataLayer.push({
																					\'ecommerce\': {
																						\'add\': {
																							\'products\': [
																								{
																									\'id\': \''.$result_other_goods['id'].'\',
																									\'name\': \''.$result_other_goods['name'].'\',
																									\'price\': \''.$result_other_goods['price'].'\',
																									\'category\': \''.$result_other_goods['id_category'].'\',
																								}
																							]
																						}
																					}
																				});">В корзину</button>	
																				</div>
                                                                           '
                                                                           
                                                                           
					;}
					?>
				</div>
			</div>
		<script>
			gtag('event', 'view_item', {
			<?php
			require ('bd.php');
			$id = $_GET['id'];
			$goods = $mysqli->query("SELECT * FROM goods WHERE id = $id");
			echo '"items": [';
				while($result = mysqli_fetch_assoc($goods)) {
				echo '{
				  "id": "'.$result[id].'",
				  "name": "'.$result[name].'",
				  "category": "'.$result[id_category].'",
				  "price": "'.$result[price].'"
				}'; }
			  echo ']'; ?>
			});
			
			gtag('event', 'view_item', {
			<?php
			require ('bd.php');
			$id = $_GET['id'];
			$other_goods = $mysqli->query("SELECT * FROM goods limit 3");
			echo '"items": [';
				while($result_other_goods = mysqli_fetch_assoc($other_goods)) {
				echo '{
				  "id": "'.$result_other_goods[id].'",
				  "name": "'.$result_other_goods[name].'",
				  "category": "'.$result_other_goods[id_category].'",
				  "price": "'.$result_other_goods[price].'"
				},'; }
			  echo ']'; ?>
			});
			
			dataLayer.push({
				"ecommerce": {
					"detail": {
						<?php
						require ('bd.php');
						$id = $_GET['id'];
						$goods = $mysqli->query("SELECT * FROM goods WHERE id = $id");
						echo '"products": [';
						while($result = mysqli_fetch_assoc($goods)) {
							echo '{
								"id": "'.$result[id].'",
								"name": "'.$result[name].'",
								"category": "'.$result[id_category].'",
								"price": "'.$result[price].'"
							},';
						}
						echo ']'; ?>
					}
				}
			});
		</script>
		</main>

	<footer>
		<div class="copy">
			&copy Dari
			<a href="" onclick="gtag('event', 'Click', {'event_category': 'Button', 'event_label': 'VKontakte' }); yaCounter48000773.reachGoal('VKONTAKTE'); return true;"> 
			<img style="width: 45px;" src="images/VK.png" alt=""> 
			</a> 
			<a href="" onclick="gtag('event', 'Click', {'event_category': 'Button', 'event_label': 'Facebook' }); yaCounter48000773.reachGoal('FACEBOOK'); return true;"> 
			<img style="width: 45px;" src="images/FB.png" alt=""> 
			</a> 
			<a href="" onclick="gtag('event', 'Click', {'event_category': 'Button', 'event_label': 'YouTube' }); yaCounter48000773.reachGoal('YOUTUBE'); return true;"> 
			<img style="width: 45px;" src="images/YT.png" alt=""> 
			</a> 
		</div>
		<div class="follow">
			<input type="email" required placeholder="E-mail">
			<button>Подписаться</button>
		</div>
		<div class="information">+7-(911)-111-11-11<br>
			example@gmail.com
		</div>
	</footer>

		<script>
			function add_to_card(id) {
				var params = {text: id};
				$.post("add_to_card.php",params,function(data) {
					$("#card_count").html(data);
				});
			}
		</script>
	</body>
	</html>