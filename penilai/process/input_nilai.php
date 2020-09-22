<?php

include '../validate/validate.php';
include '../../config/koneksi.php';

$jawab  = [];
$soal  = [];
$peserta = '';

foreach ($_POST as $key => $value) {
	if($key == 'peserta') {
		$peserta = $value;
	} else {
		$jawab[] = $value;
		$soal[] = $key;
	}
}

$nilai = [];

$temp = 0;
$real = 0;

for ($i=0; $i < count($jawab); $i++) { 
	$temp = 0;
	if(is_array($jawab[$i])) {
		for ($j=0; $j < count($jawab[$i]); $j++) { 
			$temp += $jawab[$i][$j];
		}

		$nilai[] = $temp;
		$real += $temp;
	} else {
		$nilai[] = $jawab[$i];
		$real += $jawab[$i];
	}
}

$cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `nilai` WHERE `email` = '".$peserta."' AND `id_kriteria` = '".$_SESSION['penilai']['id_kriteria']."'"));

if($cek < 1) {
	$sub = mysqli_query($koneksi, "SELECT * FROM `sub_kriteria` WHERE `id_kriteria` = '".$_SESSION['penilai']['id_kriteria']."' ORDER BY `id`");

	$no = 0;
	while($row = mysqli_fetch_array($sub)) {
		mysqli_query($koneksi, "INSERT INTO `nilai_sub_kriteria` (`email`, `nilai`, `id_kriteria`) VALUES ('".$peserta."', '".$nilai[$no]."', '".$row['id']."')");
		++$no;
	}

	mysqli_query($koneksi, "INSERT INTO `nilai` (`email`, `nilai`, `id_kriteria`) VALUES ('".$peserta."', '".($real/count($jawab))."', '".$_SESSION['penilai']['id_kriteria']."')");


	$_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Melakukan Penilaian</div>';
	header('location:../index.php');
} else {
	$sub = mysqli_query($koneksi, "SELECT * FROM `sub_kriteria` WHERE `id_kriteria` = '".$_SESSION['penilai']['id_kriteria']."' ORDER BY `id`");

	$no = 0;
	while($row = mysqli_fetch_array($sub)) {
		mysqli_query($koneksi, "UPDATE `nilai_sub_kriteria` SET `nilai` = '".$nilai[$no]."' WHERE `email` = '".$peserta."' AND `id_kriteria` = '".$row['id']."'");
		++$no;
	}

	mysqli_query($koneksi, "UPDATE `nilai` SET `nilai` = '".($real/count($jawab))."' WHERE `email` = '".$peserta."' AND `id_kriteria` = '".$_SESSION['penilai']['id_kriteria']."'");

	mysqli_query($koneksi, "TRUNCATE `db_dina`.`aggregate_dominan`");
	mysqli_query($koneksi, "TRUNCATE `db_dina`.`concordance_dominan`");
	mysqli_query($koneksi, "TRUNCATE `db_dina`.`discordance_dominan`");
	mysqli_query($koneksi, "TRUNCATE `db_dina`.`concordance_matrix`");
	mysqli_query($koneksi, "TRUNCATE `db_dina`.`discordance_matrix`");

	$_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Melakukan Penilaian</div>';
	header('location:../index.php');
}





?>