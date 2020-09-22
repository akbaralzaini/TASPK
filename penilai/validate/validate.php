<?php

session_start();

if(isset($_SESSION['username']) && isset($_SESSION['id_role'])) {
	if($_SESSION['id_role'] != 2) {
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

$_SESSION['penilai'] = mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost', 'root', '', 'db_dina'), "SELECT `penilai`.`id_kriteria`, `kriteria`.`nama` FROM `penilai` INNER JOIN `kriteria` ON `penilai`.`id_kriteria` = `kriteria`.`id` WHERE `penilai`.`username` = '".$_SESSION['username']."'"));
?>