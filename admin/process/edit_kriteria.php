<?php 

include '../validate/validate.php';
include '../../config/koneksi.php';

if(isset($_POST['nama']) && isset($_POST['bobot'])) {
    $nama = $_POST['nama'];
    $bobot = $_POST['bobot'];

    mysqli_query($koneksi, "UPDATE `kriteria` SET `nama` = '" . $nama . "', `bobot` = '" . $bobot . "' WHERE `id` = '". $_POST['id'] ."'");

    $_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Mengubah Data</div>';
	header('location:../index.php?c='.base64_encode('daftar_kriteria').'&act='.base64_encode('2'));
}

?>