<?php 

include '../validate/validate.php';
include '../../config/koneksi.php';

if(isset($_POST['tambah']) && isset($_POST['nama']) && isset($_POST['bobot'])) {
	//Nambah kriteria
	$sql = "INSERT INTO kriteria (`nama`, `bobot`) VALUES ('".$_POST['nama']."', '".$_POST['bobot']."')";
	$query = mysqli_query($koneksi, $sql);
	//Nambah kolom di tabel
	// $tahap = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_tahap FROM tahap WHERE id = '".$_POST['tahap']."'"));
	// mysqli_query($koneksi, "ALTER TABLE `".$db."`.`".$tahap['nama_tahap']."_nilai` ADD `".$_POST['nama']."` DOUBLE NULL");
	// mysqli_query($koneksi, "ALTER TABLE `".$db."`.`".$tahap['nama_tahap']."_normalisasi` ADD `".$_POST['nama']."` DOUBLE NULL");
	// mysqli_query($koneksi, "ALTER TABLE `".$db."`.`".$tahap['nama_tahap']."_bobot` ADD `".$_POST['nama']."` DOUBLE NULL");
	// // mysqli_query($koneksi, "ALTER TABLE `".$db."`.`".$tahap['nama_tahap']."_concordance` ADD `".$_POST['nama']."` DOUBLE NULL");
	// mysqli_query($koneksi, "ALTER TABLE `".$db."`.`".$tahap['nama_tahap']."_concordance_matrix` ADD `".$_POST['nama']."` DOUBLE NULL");
	// mysqli_query($koneksi, "ALTER TABLE `".$db."`.`".$tahap['nama_tahap']."_concordance_dominan` ADD `".$_POST['nama']."` DOUBLE NULL");
	// // mysqli_query($koneksi, "ALTER TABLE `".$db."`.`".$tahap['nama_tahap']."_discordance` ADD `".$_POST['nama']."` DOUBLE NULL");
	// mysqli_query($koneksi, "ALTER TABLE `".$db."`.`".$tahap['nama_tahap']."_discordance_matrix` ADD `".$_POST['nama']."` DOUBLE NULL");
	// mysqli_query($koneksi, "ALTER TABLE `".$db."`.`".$tahap['nama_tahap']."_discordance_dominan` ADD `".$_POST['nama']."` DOUBLE NULL");
	// mysqli_query($koneksi, "ALTER TABLE `".$db."`.`".$tahap['nama_tahap']."_aggregate_dominan` ADD `".$_POST['nama']."` DOUBLE NULL");

	// mysqli_query($koneksi, "CREATE TABLE `".$db."`.`".$_POST['nama']."` ( `id` INT NOT NULL AUTO_INCREMENT, `email` VARCHAR(100) NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB");
	// mysqli_query($koneksi, "ALTER TABLE `".$db."`.`".$_POST['nama']."` ADD CONSTRAINT `".$_POST['nama']."` FOREIGN KEY (`email`) REFERENCES `user`(`username`) ON DELETE CASCADE ON UPDATE CASCADE");
	
	$_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Menambah Kriteria</div>';
	header('location:../index.php?c='.base64_encode('daftar_kriteria').'&act='.base64_encode('2'));
}


?>