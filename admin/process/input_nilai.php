<?php

include '../validate/validate.php';
include '../../config/koneksi.php';

$kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE tahap = ".$_SESSION['tahap']['id']);
$nilai = [];

while($k = mysqli_fetch_array($kriteria)) {
	$nilai[] = $k['nama'];
}

$cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `".$_SESSION['tahap']['nama_tahap']."_nilai` WHERE email = '".$_POST['email']."'"));

if($cek == 0) {
	$sql = "INSERT INTO ".$_SESSION['tahap']['nama_tahap']."_nilai (`email`, ";
	$sql1 = "VALUES ('".$_POST['email']."', ";
	for ($i=0; $i < count($nilai); $i++) {

		if($i == count($nilai)-1) {
			$sql .= "`".$nilai[$i]."`) ";
			$sql1 .= "'".$_POST[$nilai[$i]]."') ";
		} else {
			$sql .= "`".$nilai[$i]."`, ";
			$sql1 .= "'".$_POST[$nilai[$i]]."', ";
		}
	}
	mysqli_query($koneksi, $sql.$sql1);
} else {
	$sql = "UPDATE ".$_SESSION['tahap']['nama_tahap']."_nilai SET ";
	for ($i=0; $i < count($nilai); $i++) {

		if($i == count($nilai)-1) {
			$sql .= "`".$nilai[$i]."` = '".$_POST[$nilai[$i]]."' WHERE `email` = '".$_POST['email']."'";
		} else {
			$sql .= "`".$nilai[$i]."` = '".$_POST[$nilai[$i]]."', ";
		}
	}
	
	mysqli_query($koneksi, $sql);
}

$_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Menambah Kriteria</div>';
	header('location:../index.php?c='.base64_encode('daftar_peserta').'&act='.base64_encode('1'));

?>