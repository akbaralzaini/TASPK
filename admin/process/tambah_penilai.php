<?php

include '../validate/validate.php';
include '../../config/koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);
$krit = $_POST['kriteria'];

// echo "INSERT INTO `penilai` (`id_kriteria`, `username`) VALUES ('".$krit."', '".$username."')";
// exit;

mysqli_query($koneksi, "INSERT INTO `user` (`username`, `password`, `id_role`) VALUES ('".$username."', '".$password."', '2')");
mysqli_query($koneksi, "INSERT INTO `penilai` (`id_kriteria`, `username`) VALUES ('".$krit."', '".$username."')");

// exit;
$_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Menambah Penilai</div>';

header("location:../index.php?c=".base64_encode('daftar_penilai')."&act=".base64_encode('5'));

?>