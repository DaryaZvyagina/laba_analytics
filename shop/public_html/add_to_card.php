<?php session_start();?>
<?php
	$id = intval($_POST['text']);

	$products = [];

	if(isset($_SESSION['products']))
		$products = $_SESSION['products'];

	if(array_key_exists($id, $products))
		$products[$id] +=1 ;
	else
		$products[$id] = 1;

	$_SESSION['products'] = $products;

	echo '('.array_sum($_SESSION['products']).')';

	//unset($_SESSION['products']);

?>