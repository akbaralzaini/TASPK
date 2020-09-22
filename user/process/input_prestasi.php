<?php

include '../validate/validate.php';
include '../../config/koneksi.php';

if (isset($_POST['satu']) && isset($_POST['dua']) && isset($_POST['tiga'])) {
    $isi = implode(";", [$_POST['satu'], $_POST['dua'], $_POST['tiga']]);
    mysqli_query($koneksi, "INSERT INTO `pendidikan_prestasi` (`email`, `isi`, `tipe`) VALUES ('" . $_SESSION['username'] . "', '" . $isi . "', '" . $_POST['tipe'] . "')");
    if ($query) {
        $_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Menyimpan Data</div>';
    } else {
        $_SESSION['msg'] = '<div role="alert" class="alert alert-danger alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Gagal Menyimpan Data</div>';
    }
} else if (isset($_POST['prestasi']) && isset($_POST['tahun'])) {
    $isi = implode(";", [$_POST['prestasi'], $_POST['tahun']]);
    mysqli_query($koneksi, "INSERT INTO `pendidikan_prestasi` (`email`, `isi`, `tipe`) VALUES ('" . $_SESSION['username'] . "', '" . $isi . "', '" . $_POST['tipe'] . "')");
    if ($query) {
        $_SESSION['msg'] = '<div role="alert" class="alert alert-success alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Berhasil Menyimpan Data</div>';
    } else {
        $_SESSION['msg'] = '<div role="alert" class="alert alert-danger alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Gagal Menyimpan Data</div>';
    }
} else {
    $_SESSION['msg'] = '<div role="alert" class="alert alert-warning alert-dismissible"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Anda harus mengisi form terlebih dahulu</div>';
}

header("location:../index.php?c=" . base64_encode('formulir_pend_pres') . "&act=" . base64_encode('1'));
