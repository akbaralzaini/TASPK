<?php

if (isset($_GET['id'])) {
    $fileName = base64_decode($_GET['id']);
    $dir = '../user/process/berkas/';

    $file = $dir . $fileName;

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: private');
        header('Pragma: private');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);

        header("./index.php?c=" . base64_encode('detail_peserta') . "&act=" . base64_encode(1) . "&pid=" . base64_encode($_GET['id_peserta']));
    } else {
        $_SESSION['pesan'] = "Oops! File - $filename - not found ...";
        header("./index.php?c=" . base64_encode('detail_peserta') . "&act=" . base64_encode(1) . "&pid=" . base64_encode($_GET['id_peserta']));
    }
}
