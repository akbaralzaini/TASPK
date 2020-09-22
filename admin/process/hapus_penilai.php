<?php

include '../validate/validate.php';
include '../../config/koneksi.php';

mysqli_query($koneksi, "DELETE FROM `user` WHERE `username` = '".$_GET['username']."'");

$_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Menghapus Penilai</div>';

header("location:../index.php?c=".base64_encode('daftar_penilai')."&act=".base64_encode('5'));

?>