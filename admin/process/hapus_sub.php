<?php

include '../validate/validate.php';
include '../../config/koneksi.php';

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM `sub_kriteria` WHERE `id` = '".$id."'");

header('location:../index.php?c='.base64_encode('daftar_kriteria').'&act='.base64_encode('2'));


?>