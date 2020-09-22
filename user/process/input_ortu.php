<?php

include '../validate/validate.php';
include '../../config/koneksi.php';

if(isset($_POST['nama_ayah']) && $_POST['nama_ibu']) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `data_orangtua` WHERE `email` = '".$_SESSION['username']."'"));
	if($cek > 0) {
		$sql = "UPDATE `data_orangtua` SET 
			`nama_ayah`='".$_POST['nama_ayah']."',
			`pekerjaan_ayah`='".$_POST['pekerjaan_ayah']."',
			`hp_ayah`='".$_POST['hp_ayah']."',
			`nama_ibu`='".$_POST['nama_ibu']."',
			`pekerjaan_ibu`='".$_POST['pekerjaan_ibu']."',
			`hp_ibu`='".$_POST['hp_ibu']."' WHERE `email` = '".$_SESSION['username']."'";
	} else {
		$sql = "
			INSERT INTO `data_orangtua`(`nama_ayah`, `pekerjaan_ayah`, `hp_ayah`, `nama_ibu`, `pekerjaan_ibu`, `hp_ibu`) VALUES (
				'".$_POST['nama_ayah']."',
				'".$_POST['pekerjaan_ayah']."',
				'".$_POST['hp_ayah']."',
				'".$_POST['nama_ibu']."',
				'".$_POST['pekerjaan_ibu']."',
				'".$_POST['hp_ibu']."'
				) WHERE `email` = '".$_SESSION['username']."'";
	}

	$query = mysqli_query($koneksi, $sql);

	if($query) {
		$_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Menyimpan</div>';
	} else {
		$_SESSION['msg'] = '<div role="alert" class="alert alert-danger alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Gagal Menyimpan</div>';
	}

	header('location:../index.php?c='.base64_encode('formulir_ortu').'&act='.base64_encode(1));
} else {
	$_SESSION['msg'] = '<div role="alert" class="alert alert-warning alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Anda harus mengisi form</div>';
	header('location:../index.php?c='.base64_encode('formulir_ortu').'&act='.base64_encode(1));
}
