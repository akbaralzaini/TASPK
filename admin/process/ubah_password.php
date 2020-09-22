<?php 

include '../validate/validate.php';
include '../../config/koneksi.php';

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    mysqli_query($koneksi, "UPDATE `user` SET `password` = '" . md5($password) . "' WHERE `username` = '".$username."'");
    $_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Merubah Password</div>';
} else {
    $_SESSION['msg'] = '<div role="alert" class="alert alert-danger alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Gagal Merubah Password</div>';

}

header('location:../index.php?c='.base64_encode('daftar_kriteria').'&act='.base64_encode('2'));
?>