<?php

include './config/auth.php';
include './config/koneksi.php';

if(isset($_POST['email']) && isset($_POST['nama']) && isset($_POST['password']) && isset($_POST['re-password'])) {
	$sqls = "SELECT * FROM user WHERE username = ".$_POST['email'];
	$query = mysqli_query($koneksi, $sqls);

	if($query == null) {
		$sql = "INSERT INTO user VALUES ('".$_POST['email']."', '".md5($_POST['password'])."', 3)";
		$sql1 = "INSERT INTO peserta(`email`, `nama`) VALUES ('".$_POST['email']."', '".$_POST['nama']."')";
		$sql2 = "INSERT INTO `data_orangtua` (`email`) VALUES ('".$_POST['email']."')";

		mysqli_query($koneksi, $sql);
		mysqli_query($koneksi, $sql1);
		mysqli_query($koneksi, $sql2);

		$_SESSION['username'] = $_POST['username'];
		$_SESSION['id_role'] = 3;
		header('location:index.php');
		exit;
	} else {
		header('location:index.php');
		exit;
	}
}


?>