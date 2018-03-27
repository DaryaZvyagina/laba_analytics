<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="styles/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
	<script src="js/jquery-3.3.1.min.js"></script>
	<title>Bouquet Shop</title>
</head>
<body>

	<header>
		<div class="logo"><a href="index.php">Bouquet Shop</a></div>
		<div class="basket">
			<a href="basket.php"> <span id="card_count">(<?php if(isset($_SESSION['products']))
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
			<?php
				require ('bd.php');
				$name = $_GET['s'];
				$goods = $mysqli->query("SELECT * FROM goods where name LIKE '%".$name."%' ORDER BY name");
				while ($result = mysqli_fetch_assoc($goods)) {
					echo '<a href="product.php?id='.$result['id'].'">'.$result['name'].'</a>';
				}
				?>
	</main>

	<footer>
		<div class="copy">
			&copy Dari
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