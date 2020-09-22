<?php

include './config/auth.php';
include './config/koneksi.php';

if(isset($_POST['username']) && isset($_POST['password'])) {
	$sql = "SELECT * FROM user WHERE username = '".$_POST['username']."' AND password = '".md5($_POST['password'])."'";
	$query = mysqli_query($koneksi, $sql);
	$cek = mysqli_fetch_assoc($query);

	if($cek != null) {
		$_SESSION['username'] = $cek['username'];
		$_SESSION['id_role'] = $cek['id_role'];
	} else {
		$_SESSION['msg'] = "Username / Password Salah";
	}
} else {
	$_SESSION['msg'] = "Username / Password Salah";
}

header('location:index.php');

?>