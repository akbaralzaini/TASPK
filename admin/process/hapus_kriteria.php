<?php 

include '../validate/validate.php';
include '../../config/koneksi.php';

$id = base64_decode($_GET['id']);

$sql = "DELETE FROM kriteria WHERE id = '".$id."'";

mysqli_query($koneksi, $sql);
mysqli_query($koneksi, "TRUNCATE `db_dina`.`aggregate_dominan`");
mysqli_query($koneksi, "TRUNCATE `db_dina`.`concordance_dominan`");
mysqli_query($koneksi, "TRUNCATE `db_dina`.`discordance_dominan`");
mysqli_query($koneksi, "TRUNCATE `db_dina`.`concordance_matrix`");
mysqli_query($koneksi, "TRUNCATE `db_dina`.`discordance_matrix`");

header('location:../index.php?c='.base64_encode('daftar_kriteria').'&act='.base64_encode('2'));

?>