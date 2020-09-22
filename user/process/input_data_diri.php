<?php

include '../validate/validate.php';
include '../../config/koneksi.php';

if (isset($_POST)) {
	if (isset($_FILES['files'])) {
		$id_peserta = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT `id_peserta` FROM `peserta` WHERE `email` = '" . $_SESSION['username'] . "'"));
		$temp = explode(".", $_FILES["files"]["name"]);
		$newfilename = $id_peserta['id_peserta'] . '.' . end($temp);
		$namaSementara = $_FILES['files']['tmp_name'];

		$dirUpload = "foto_peserta/";

		if (file_exists($dirUpload . $newfilename)) {
			unlink($dirUpload . $newfilename);
		}

		$terupload = move_uploaded_file($namaSementara, $dirUpload . $newfilename);

		if ($terupload) {
			$sql = "UPDATE `peserta` SET 
				`email`= '" . $_POST['email'] . "',
				`nama`= '" . $_POST['nama'] . "',
				`panggilan`= '" . $_POST['panggilan'] . "',
				`jk`= '" . $_POST['jk'] . "',
				`tgl_lhr`= '" . $_POST['tgl'] . "',
				`tempat`= '" . $_POST['tempat'] . "',
				`alamat`= '" . $_POST['alamat'] . "',
				`pekerjaan`= '" . $_POST['pekerjaan'] . "',
				`agama`= '" . $_POST['agama'] . "',
				`nomor`= '" . $_POST['wa'] . "',
				`instagram`= '" . $_POST['ig'] . "',
				`line`= '" . $_POST['line'] . "',
				`tb`= '" . $_POST['tb'] . "',
				`bb`= '" . $_POST['bb'] . "',
				`bakat`= '" . $_POST['bakat'] . "',
				`bahasa`= '" . $_POST['bahasa'] . "',
				`foto` = '" . $newfilename . "' 
				WHERE email = '" . $_SESSION['username'] . "'";
			$query = mysqli_query($koneksi, $sql);

			if ($query) {
				$_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Menyimpan</div>';
			} else {
				$_SESSION['msg'] = '<div role="alert" class="alert alert-danger alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Gagal Menyimpan</div>';
			}
		} else {
			$_SESSION['msg'] = '<div role="alert" class="alert alert-danger alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Gagal Mengunggah Foto</div>';
		}
	} else {
		$_SESSION['msg'] = '<div role="alert" class="alert alert-warning alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Pilih berkas anda</div>';
	}

	header('location:../index.php?c=' . base64_encode('formulir') . '&act=' . base64_encode(1));
}
