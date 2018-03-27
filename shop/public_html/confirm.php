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

	  gtag('event', 'page_name', {'pageType': 'confirm'});

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
			</div>
		<div>
		<div class="goods">
			<h1>Спасибо за заказ!</h1>
			<table class="table-bordered table-striped table">
				<tr>
					<th>Код товара</th>
					<th>Название</th>
					<th>Стомость, руб.</th>
					<th>Количество, шт</th>
				</tr>
				<?php
				require ('bd.php');
				if(isset($_SESSION['products'])) {
					foreach ($_SESSION['products'] as $key => $value) {
						$id_product = $mysqli->query("SELECT * FROM goods WHERE id = $key");
						$result = mysqli_fetch_assoc($id_product);
						$result['price'] = (int)($result['price']);
						$all +=  $result['price'] * $value.'<br>';
						echo '<tr>
						<td>'.$result['id'].'</td>
						<td>
						<a href="/product/106">'.$result['name'].'</a>
						</td>
						<td>'.$result['price'].'</td>
						<td>'.$value.'</td>
						</tr>';
					};  echo '<tr>
						<td colspan="3">Общая стоимость руб.</td>
						<td>'; if(isset($all)) echo $all.'</td>
					</tr>'; }?>

				</table>
			<div class="confirm_info">
				Ваш номер заказа: <?php 
				$number = rand(0,10000000); 
				echo $number; ?>
			<br>Наши сотрудники в скором времени уточнят детали заказа.
			</div>
			</div>

			<script> 
				gtag('event', 'purchase', { 
					<?php 
						require ('bd.php'); 
						if(isset($_SESSION['products'])) { 
						echo '"transaction_id": "'.$number.'",'; 
						echo '"items": ['; 
							foreach ($_SESSION['products'] as $key => $value) { 
							$id_product = $mysqli->query("SELECT * FROM goods WHERE id = $key"); 
							$result = mysqli_fetch_assoc($id_product); 
							$result['price'] = (int)($result['price']); 
							$all += $result['price'] * $value; 
							echo '{ 
								"id": "'.$result[id].'", 
								"name": "'.$result[name].'", 
								"category": "'.$result[id_category].'", 
								"quantity": '.$value.', 
								"price": "'.$result[price].'" 
								},'; 
							}; 
						echo ']'; 
					}?> 
				}); 
				dataLayer.push({
				    "ecommerce": {
				        "purchase": {
				        	<?php
				        	require ('bd.php'); 
							if(isset($_SESSION['products'])) {
				            echo '"actionField": {
				                "id" : "'.$number.'"
				            },
				            "products": [';
				            foreach ($_SESSION['products'] as $key => $value) { 
							$id_product = $mysqli->query("SELECT * FROM goods WHERE id = $key"); 
							$result = mysqli_fetch_assoc($id_product); 
							$result['price'] = (int)($result['price']); 
							$all += $result['price'] * $value; 
							echo '{ 
								"id": "'.$result[id].'", 
								"name": "'.$result[name].'", 
								"category": "'.$result[id_category].'", 
								"quantity": '.$value.', 
								"price": "'.$result[price].'" 
								},'; 
							}; 
				            echo ']';  
				        	}?>
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
		<?php
		unset($_SESSION['products']);
		?>
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