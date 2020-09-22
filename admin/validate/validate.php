<?php

session_start();

if(isset($_SESSION['username']) && isset($_SESSION['id_role'])) {
	if($_SESSION['id_role'] != 1) {
		session_destroy();
		$_SESSION['msg'] = "Kamu harus login dulu";
		header('location:../index.php');
	}
} else {
	session_destroy();
	$_SESSION['msg'] = "Kamu harus login dulu";
	header('location:../index.php');
}
if(isset($_GET['c']) && $_GET['act']) {
	include '../config/koneksi.php';
}

?>