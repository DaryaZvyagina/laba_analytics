<?php session_start()?>

<?php
	$id = $_GET['id'];
	unset($_SESSION['products'][$id]);
	header("Location: basket.php");
?>