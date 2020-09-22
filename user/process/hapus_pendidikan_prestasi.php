<?php

include '../validate/validate.php';
include '../../config/koneksi.php';

if ($_GET['id']) {
    $id = base64_decode($_GET['id']);
    $query = mysqli_query($koneksi, "DELETE FROM `pendidikan_prestasi` WHERE `id` = '" . $id . "'");

    if ($query) {
        $_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Menghapus Data</div>';
    } else {
        $_SESSION['msg'] = '<div role="alert" class="alert alert-danger alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Gagal Menghapus Data</div>';
    }
} else {
    $_SESSION['msg'] = '<div role="alert" class="alert alert-warning alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Data tidak ditemukan</div>';
}

header("location:../index.php?c=" . base64_encode('formulir_pend_pres') . "&act=" . base64_encode('1'));
