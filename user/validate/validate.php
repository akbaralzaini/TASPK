<?php

session_start();

if(isset($_SESSION['username']) && isset($_SESSION['id_role'])) {
	if($_SESSION['id_role'] != 3) {
		session_destroy();
		$_SESSION['msg'] = "Kamu harus login dulu";
		header('location:../index.php');
	}
} else {
	session_destroy();
	$_SESSION['msg'] = "Kamu harus login dulu";
	header('location:../index.php');
}

?>