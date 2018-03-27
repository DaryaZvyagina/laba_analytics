<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114366047-1"></script>
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

	   gtag('event', 'page_name', {'pageType': 'goods'});

	  setTimeout(function(){ gtag('event', location.pathname, { 'event_category': 'Новый посетитель' }); }, 15000);
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
		<div>
		<div class="goods">
			<h1>Новые товары</h1>
			<?php
			require ('bd.php');
			$id = $_GET['id'];
			$goods = $mysqli->query("SELECT * FROM goods WHERE id_category = $id");
			while($result = mysqli_fetch_assoc($goods)) {
			echo '<div class="product">
				<img src="images/goods/'.$result['img'].'.jpg" alt="" width="300px" height="385px">
				<div class="description">
					<p class="name_of_product"><a onclick="
							onClick="gtag(\'event\', \'select_content\', { 
								\'content_type\': \'product\', 
									\'items\': [ 
										{ 
										\'id\': \''.$result['id'].'\', 
										\'name\':\''.$result['name'].'\', 
										\'category\': \''.$result['id_category'].'\', 
										\'price\': '.$result['price'].' 
										} 
									] 
								});"
					" href="product.php?id='.$result['id'].'">'.$result['name'].'</a></p>
					<span>'.$result['price'].' руб.</span><br>
					<button onclick="add_to_card('.$result['id'].');
						gtag(\'event\', \'Click\', { \'event_category\': \'Button\', \'event_label\': \'catalog_in_basket\' }); 
						yaCounter48000773.reachGoal(\'CATALOG_IN_BASKET\');
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
								                    \'id\': \''.$result['id'].'\', 
													\'name\': \''.$result['name'].'\', 
													\'category\': \''.$result['id_category'].'\', 
													\'price\': \''.$result['price'].'\' 
								                }
								            ]
								        }
								    }
								});
						">В корзину</button>
				</div>
			</div>';
			} ?>
		</div>
		<script> 
			gtag('event', 'view_item_list', { 
				<?php 
					require ('bd.php'); 
					$id = $_GET['id']; 
					$goods = $mysqli->query("SELECT * FROM goods WHERE id_category = $id"); 
					echo '"items": ['; 
					while($result = mysqli_fetch_assoc($goods)){ 
					echo '{ 
						"id": "'.$result[id].'", 
						"name": "'.$result[name].'", 
						"category": "'.$result[id_category].'", 
						"price": "'.$result[price].'" 
						},'; 
					}; 
					echo ']'; ?> 
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