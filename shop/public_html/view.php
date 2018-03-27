<?php session_start();?>
<?php
	require('bd.php');
	foreach ($_SESSION['products'] as $key => $value) {
		$id_product = $mysqli->query("SELECT * FROM goods WHERE id = $key");
		$result = mysqli_fetch_assoc($id_product);
		echo $result['name'].'<br>';
	}

	echo '<pre>';
	print_r($_SESSION['products']);
?>