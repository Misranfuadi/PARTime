<?php 
	session_start();
	unset($_SESSION['titel']);
	unset($_SESSION['tabel']);
	header('location:../index.php'); 
 ?>