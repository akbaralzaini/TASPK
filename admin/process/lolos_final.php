<?php

include '../validate/validate.php';
include '../../config/koneksi.php';

if (isset($_GET['id'])) {
    $query = mysqli_query($koneksi, "UPDATE `peserta` SET `status` = '2' WHERE `email` = '" . base64_decode($_GET['id']) . "'");
    if ($query) {
        $_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Meloloskan Peserta</div>';
    } else {
        $_SESSION['msg'] = '<div role="alert" class="alert alert-danger alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>gagal Meloloskan Peserta</div>';
    }
} else {
    $_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Peserta Tidak Ditemukan</div>';
}

header("location:../index.php?c=" . base64_encode('daftar_peserta') . "&act=" . base64_encode('1'));
