<?php
include "../config/koneksi.php";
require_once("../dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();

function pemenang($array)
{
    $val_count = 0;
    $tmp_name = "";

    while ($row = mysqli_fetch_array($array)) {
        $value = explode(';', $row['nilai']);
        $tmp_val = 0;

        for ($i = 0; $i < count($value); $i++) {
            if ($value[$i] !== '-') {
                $tmp_val += $value[$i];
            }
        }

        if ($tmp_val > $val_count) {
            $tmp_name = $row['nama'];
            $val_count = $tmp_val;
        }
    }

    return $tmp_name;
}

function nilai($jk)
{
    $koneksi = mysqli_connect('localhost', 'root', '', 'db_dina');
    $query = mysqli_query($koneksi, "SELECT `peserta`.*, `aggregate_dominan`.`nilai` FROM `aggregate_dominan` INNER JOIN `peserta` ON `aggregate_dominan`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = " . $jk . " ORDER BY `aggregate_dominan`.`id` ASC");

    $tmp_array = [];
    $num = 0;

    while ($data = mysqli_fetch_array($query)) {
        $value = explode(';', $data['nilai']);
        $tmp_val = 0;

        for ($i = 0; $i < count($value); $i++) {
            if ($value[$i] !== '-') {
                $tmp_val += $value[$i];
            }
        }

        $tmp_array[$num][] = $data['nama'] . " / " . $data['id_peserta'];
        $tmp_array[$num][] = $tmp_val;

        ++$num;
    }

    return $tmp_array;
}

$pemenang_pa = mysqli_query($koneksi, "SELECT * FROM `aggregate_dominan` INNER JOIN `peserta` ON `aggregate_dominan`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = 1 ORDER BY `aggregate_dominan`.`id` ASC");
$pemenang_pi = mysqli_query($koneksi, "SELECT * FROM `aggregate_dominan` INNER JOIN `peserta` ON `aggregate_dominan`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = 2 ORDER BY `aggregate_dominan`.`id` ASC");

$pemenang_putra = pemenang($pemenang_pa);
$pemenang_putri = pemenang($pemenang_pi);

$nilai_putra = nilai(1);
$nilai_putri = nilai(2);

$juri = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `kriteria`"));

$html = "<!DOCTYPE html><html><head>
            <title>Cetak Berita Acara PDF</title>
            <style>" .
    "
            html, body {
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                color: #222;
            }

            .divider {
                padding: 10px;
            }

            p {
                margin: 0 !important;
            }
        " .
    "</style></head><body>";

$html .= '<table width="100%">';

//KOP BERITA
$html .=
    '<tr>' .
    '<td style="width:15%;"><center><img src="../assets/img/logo-1.png" height="70"></center></td>' .
    '<td style="width:70%" colspan="2">
            <center>
                <h3>
                    PEMERINTAH KOTA PALEMBANG <br>
                    DINAS KEBUDAYAAN <br>
                    IKATAN CEK BAGUS CEK AYU PALEMBANG
                </h3>
            </center>
        </td>' .
    '<td style="width:15%"><center><img src="../assets/img/logo-2.png" height="100"></center></td>
    </tr>';

$html .= '<tr>
        <td colspan="4" style="border-top: 3px solid #333; border-bottom: 3px solid #333;">
            <h2 style="margin-top:10px"><center>HASIL PERHITUNGAN SPK</center></h2>
            <h3 style="margin-top:-15px"><center>PEMILIHAN DUTA BUDAYA KOTA PALEMBANG</center></h3>
        </td>
    </tr><tr><td colspan="3" class="divider"></td></tr><tr><td colspan="2" style="padding-bottom: 10px;"><b>Perhitungan Cek Bagus</b></td><td colspan="2"><b>Perhitungan Cek Ayu</b></td></tr>';

for ($i = 0; $i < count($nilai_putra); $i++) {
    $html .= '<tr style="font-size: 12px;"><td colspan="2"><p style="display; inline; position: absolute;">' . $nilai_putra[$i][0] . '</p><p style="text-align: center; padding-left: 55px;"> <small><b>SKOR : <b></small>' . $nilai_putra[$i][1] . '</p></td><td colspan="2"><p style="display; inline; position: absolute;">' . $nilai_putri[$i][0] . '</p><p style="text-align: center; padding-left: 55px;"> <small><b>SKOR : <b></small>' . $nilai_putri[$i][1] . '</p></td></tr>';
}

//Kalo Nk Ngubah beritany kak

$html .= '<tr><td colspan="3" class="divider"></td></tr><tr>
        <td colspan="4">
            <p style="text-indent:50px;text-align: justify;text-justify: inter-word; font-size:12px;">
                Berdasarkan hasil perhitungan akhir yang diperoleh, peserta yang memiliki skor tertinggi direkomendasikan untuk menjadi Duta Budaya Kota Palembang yang terpilih. Perhitungan ini berdasarkan kriteria dan sub kriteria yang telah diinput ke dalam sistem untuk diproses sehingga mengalami berbagai eliminasi dan didapatkan output / hasil yang memiliki nilai dominan terbanyak dari sekian banyak alternatif yang tersedia. Oleh sebab itu Duta Budaya Palembang terpilih pada tahun ini adalah peserta yang memiliki skor tertinggi, yaitu :
            </p>
        </td>
    
    </tr>
    <tr><td colspan="3" class="divider"></td></tr>
    <tr style="font-size:13px;">
        <td colspan="2">
            <b>Cek Bagus : </b>
            ' . $pemenang_putra . '
        </td>
        <td colspan="2">
            <b>Cek Ayu : </b>
            ' . $pemenang_putri . '
        </td>
    </tr>';

$html .= '<tr><td colspan="4" class="divider"></td></tr><tr><td colspan="4">
    <h3 style="margin:0;"><center>BERITA ACARA</center></h3>
</td></tr>';

$html .= '<tr><td colspan="4" class="divider"></td></tr>
        <tr><td colspan="4" style="font-size: 12px;">Dengan ini kami para dewan juri sepakat memilih nama tersebut sebagai Duta Budaya Kota Palembang</td></tr>
        
        <tr><td colspan="3" class="divider"></td></tr>
        <tr style="font-size:12px">';
for ($i = 1; $i <= $juri; $i++) {
    $html .= '<td colspan="2"><p style="display; inline; position: absolute;">Juri ' . $i . '</p><p style="padding-left: 100px;">[.................................]</p></td>';

    if ($i % 2 == 0) {
        $html .= '</tr><tr  style="font-size:12px">';
    }
}

$html .= '</tr><tr><td colspan="4" class="divider"></td></tr><tr><td colspan="4">
                <h3 style="margin:0;"><center>MENGETAHUI</center></h3>
            </td></tr></tr><tr><td colspan="4" class="divider"></td></tr><tr><td colspan="4">';

$html .= '<tr style="font-size:12px; text-align: center">
            <td colspan="2">
                <p>Disbud Palembang</p> <br><br><br><br>
                <p>[.................................]</p>
            </td>
            <td colspan="2">
                <p>CBCA Palembang</p> <br><br><br><br>
                <p>[.................................]</p>
            </td>';


$html .= '</table></body></html>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('Berita Acara PDB.pdf', array("Attachment" => false));
