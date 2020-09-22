<?php

include '../validate/validate.php';
include '../../config/koneksi.php';

if (isset($_FILES['files'])) {

	$namaFile = $_FILES['files']['name'];
	$namaSementara = $_FILES['files']['tmp_name'];

	$dirUpload = "berkas/";

	if (file_exists($dirUpload . $namaFile)) {
		unlink($dirUpload . $namaFile);
	}

	$terupload = move_uploaded_file($namaSementara, $dirUpload . $namaFile);

	if ($terupload) {
		mysqli_query($koneksi, "UPDATE `peserta` SET `berkas` = '" . $namaFile . "' WHERE `email` = '" . $_SESSION['username'] . "'");
		$_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Mengupload File</div>';
	} else {
		$_SESSION['msg'] = '<div role="alert" class="alert alert-danger alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Gagal Mengunggah Berkas</div>';
	}
} else {
	$_SESSION['msg'] = '<div role="alert" class="alert alert-warning alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Pilih berkas anda</div>';
}
header('location:../index.php?c=' . base64_encode('unggah') . '&act=' . base64_encode(2));
