<?php

include '../validate/validate.php';
include '../../config/koneksi.php';


$id_kriteria = $_GET['id'];

$tipe = $_POST['tipe_nilai'];
$input = '';

if($tipe == 2) {
	$soal = implode('|', $_POST['pilihan']);
	$nilai = implode(';', $_POST['nilai']);
	
	$input = implode('`', [$soal,$nilai]);
} else if($tipe != 1) {
	$_SESSION['msg'] = '<div role="alert" class="alert alert-danger alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Pilih tipe penilaian</div>';
	
	header('location:../index.php?c='.base64_encode('daftar_kriteria').'&act='.base64_encode('2'));
	exit;
}

// echo "INSERT INTO `pertanyaan` (`id_kriteria`, `tipe`, `soal`) VALUES ('".$id_kriteria."', '".$tipe."', '".base64_encode($input)."')";

// exit;

$nama_kriteria = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT `nama` FROM `kriteria` WHERE id = '".$id_kriteria."'"));

$sql = "INSERT INTO `sub_kriteria` (`id_kriteria`, `nama`) VALUES('".$id_kriteria."', '".$_POST['nama']."')";
$query = mysqli_query($koneksi, $sql);

$id_sub = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT `id` FROM `sub_kriteria` WHERE `id_kriteria` = '".$id_kriteria."' AND `nama` = '".$_POST['nama']."'"));

mysqli_query($koneksi, "INSERT INTO `pertanyaan` (`id_kriteria`, `tipe`, `soal`) VALUES ('".$id_sub['id']."', '".$tipe."', '".base64_encode($input)."')");

mysqli_query($koneksi, "ALTER TABLE `".$db."`.`".$nama_kriteria['nama']."` ADD `".$_POST['nama']."` DOUBLE NULL");

if($query) {
	$_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Menambah Kriteria</div>';
	header('location:../index.php?c='.base64_encode('daftar_kriteria').'&act='.base64_encode('2'));
} else {
	
	header('location:../index.php?c='.base64_encode('daftar_kriteria').'&act='.base64_encode('2'));
}

?>