<?php
include '../validate/validate.php';
include '../../config/koneksi.php';

function map_to_array($sql) {
    $koneksi = mysqli_connect('localhost', 'root', '', 'db_dina');
    $query = mysqli_query($koneksi, $sql);
    $ret_arr = [];

    while($user = mysqli_fetch_array($query)) {
        $queries = mysqli_query($koneksi, "SELECT * FROM `nilai` WHERE `email` = '".$user['email']."' ORDER BY `id_kriteria` ASC");
        while($nilai = mysqli_fetch_array($queries)) {
            $nilai_pembulatan = round($nilai['nilai']);
            $tmp_nilai = 0;
            if($nilai_pembulatan > 92) {
                $tmp_nilai = 4;
            } else if($nilai_pembulatan > 80) {
                $tmp_nilai = 3;
            } else if($nilai_pembulatan > 68) {
                $tmp_nilai = 2;
            } else if($nilai_pembulatan > 50) {
                $tmp_nilai = 1;
            }

            $ret_arr[$user['nama']][] = $tmp_nilai;
        }
    }

    return $ret_arr;
}

function normalisasi($array) {
    $tmp_array = $array;
    $ret_array = [];
    
    foreach ($array as $key => $value) {
        for ($i=0; $i < count($value); $i++) { 
            $tmp_sum = 0;
            foreach ($tmp_array as $v) {
                $tmp_sum += pow(2, $v[$i]);
            }

            $ret_array[$key][] = $value[$i] / sqrt($tmp_sum);
        }
    }

    return $ret_array;
}

function pembobotan($array) {
    $koneksi = mysqli_connect('localhost', 'root', '', 'db_dina');
    $count = mysqli_query($koneksi, "SELECT `bobot` FROM `kriteria` ORDER BY `id` ASC");
    $tmp_arr = $array;
    $num =0;

    while($bobot = mysqli_fetch_array($count)) {
        foreach ($array as $key => $value) {
            $tmp_arr[$key][$num] = $array[$key][$num] * $bobot['bobot'];
        }

        ++$num;
    }

    return $tmp_arr;
}

function concordance($array)
{
    $tmp_arr = $array;
    $ret_arr = [];

    foreach ($array as $key => $value) {
        foreach($tmp_arr as $k => $v) {
            $tmp_value = [];

            if($key != $k) {
                for ($i=0; $i < count($value); $i++) { 
                    if($value[$i] >= $v[$i]) {
                        $tmp_value[] = $i;
                    }
                }
            } else {
                $tmp_value[] = '-';
            }

            $ret_arr[$key][] = $tmp_value;
        }
    }

    return $ret_arr;
}

function discordance($array)
{
    $tmp_arr = $array;
    $ret_arr = [];

    //Main person
    foreach ($array as $key => $value) {
        foreach($tmp_arr as $k => $v) {
            $tmp_value = [];

            if($key != $k) {
                for ($i=0; $i < count($value); $i++) { 
                    if($value[$i] < $v[$i]) {
                        $tmp_value[] = $i;
                    }
                }
            } else {
                $tmp_value[] = '-';
            }

            $ret_arr[$key][] = $tmp_value;
        }
    }

    return $ret_arr;
}

function map_value_to_array() {
    $koneksi = mysqli_connect('localhost', 'root', '', 'db_dina');
    $count = mysqli_query($koneksi, "SELECT `bobot` FROM `kriteria` ORDER BY `id` ASC");
    $array = [];

    while($bobot = mysqli_fetch_array($count)) {
        $array[] = $bobot['bobot'];
    }

    return $array;
}

function matriks_concordance($array) {
    $temp_arr = [];
    $bobot = map_value_to_array();

    //Mencari matriks
    foreach ($array as $key => $value) {
        for ($i=0; $i < count($value); $i++) {
            $temp_val = 0;
            for ($j=0; $j < count($value[$i]); $j++) {
                if($value[$i][$j] != '-') {
                    $temp_val += $bobot[$value[$i][$j]];
                }
            }

            if($temp_val == 0) {
                $temp_arr[$key][] = '-';
            } else {
                $temp_arr[$key][] = $temp_val;
            }
        }
    }

    insertToDb($temp_arr, "concordance_matrix");

    //Mencari Nilai Matriks
    $treshold = treshold($temp_arr);
    $ret_array = [];

    foreach($temp_arr as $key => $value) {
        for ($i=0; $i < count($value); $i++) { 
            if($value[$i] !== '-') {
                if($value[$i] >= $treshold) {
                    $ret_array[$key][] = 1;
                } else {
                    $ret_array[$key][] = 0;
                }
            } else {
                $ret_array[$key][] = '-';
            }
        }
    }

    insertToDb($ret_array, "concordance_dominan");

    return $ret_array;
}

function matriks_discordance($array, $weight_array)
{
    $temp_arr = $array;
    $tmp_weight = $weight_array;
    $ret_array = [];

    foreach($temp_arr as $key => $value) {
        foreach($tmp_weight as $k => $v) {
            if($key != $k) {
                $tmp_arr = [];
                $tmp_top = [];
                for ($i=0; $i < count($v); $i++) { 
                    $tmp_arr[] = abs($weight_array[$key][$i] - $v[$i]);
                }

                foreach ($value as $y => $e) {
                    for ($i=0; $i < count($e); $i++) {
                        if($e[$i] !== '-') {
                            $tmp_top[] = abs($weight_array[$key][$e[$i]] - $v[$e[$i]]);
                        } else {
                            
                        }
                    }
                }

                $ret_array[$key][] = max($tmp_top) / max($tmp_arr);
            } else {
                $ret_array[$key][] = '-';
            }
        }
    }

    insertToDb($ret_array, "discordance_matrix");

    //Mencari Nilai Matriks
    $treshold = treshold($ret_array);
    $ret_arr = [];

    foreach($ret_array as $key => $value) {
        for ($i=0; $i < count($value); $i++) { 
            if($value[$i] !== '-') {
                if($value[$i] >= $treshold) {
                    $ret_arr[$key][] = 1;
                } else {
                    $ret_arr[$key][] = 0;
                }
            } else {
                $ret_arr[$key][] = '-';
            }
        }
    }

    insertToDb($ret_arr, "discordance_dominan");

    return $ret_arr;
}

function treshold($array)
{
    $count = count($array);
    $tmp_array = $array;
    $total = 0;

    foreach ($array as $key => $value) {
        for ($i=0; $i < count($value); $i++) { 
            if($value[$i] !== '-') {
                $total += $value[$i];
            }
        }
    }

    return $total / ($count * ($count - 1));
}

function aggregate_dominan($concor, $discor) {
    $ret_array = [];

    foreach ($concor as $key => $value) {
        for ($i=0; $i < count($value); $i++) { 
            if($value[$i] !== '-') {
                $ret_array[$key][] = $value[$i] * $discor[$key][$i];
            } else {
                $ret_array[$key][] = '-';
            }
        }
    }

    insertToDb($ret_array, "aggregate_dominan");

    return $ret_array;
}

function insertToDb($array, $table_name)
{
    $koneksi = mysqli_connect('localhost', 'root', '', 'db_dina');
    
    foreach ($array as $key => $value) {
        $sql = "SELECT `email` FROM `peserta` WHERE `nama` = '".$key."'";
        $nilai = implode(';', $value);

        $email = mysqli_fetch_assoc(mysqli_query($koneksi, $sql));

        if(!check_exist($email['email'], $table_name)) {
            mysqli_query($koneksi, "INSERT INTO `" . $table_name . "` (`user`, `nilai`) VALUES ('" . $email['email'] . "', '" . $nilai . "')");
        }
    }
}

function check_exist($prim_key, $table_name)
{
    $koneksi = mysqli_connect('localhost', 'root', '', 'db_dina');
    $sql = "SELECT * FROM `" . $table_name . "` WHERE `user` = '" . $prim_key . "'";
    $cek = mysqli_num_rows(mysqli_query($koneksi, $sql));
    
    if($cek > 0) {
        return true;
    } return false;
}

$sql_putra = "SELECT `nama`, `email` FROM `peserta`WHERE `jk` = '1' ORDER BY `id_peserta` ASC";
$sql_putri = "SELECT `nama`, `email` FROM `peserta`WHERE `jk` = '2' ORDER BY `id_peserta` ASC";

$putra = map_to_array($sql_putra);
$putri = map_to_array($sql_putri);

$normalisasi_putra = normalisasi($putra);
$normalisasi_putri = normalisasi($putri);

$pembobotan_putra = pembobotan($normalisasi_putra);
$pembobotan_putri = pembobotan($normalisasi_putri);

$concordance_putra = concordance($pembobotan_putra);
$concordance_putri = concordance($pembobotan_putri);

$discordance_putra = discordance($pembobotan_putra);
$discordance_putri = discordance($pembobotan_putri);

$matriks_concordance_putra = matriks_concordance($concordance_putra);
$matriks_concordance_putri = matriks_concordance($concordance_putri);

$matriks_discordance_putra = matriks_discordance($discordance_putra, $pembobotan_putra);
$matriks_discordance_putri = matriks_discordance($discordance_putri, $pembobotan_putri);

aggregate_dominan($matriks_concordance_putra, $matriks_discordance_putra);
aggregate_dominan($matriks_concordance_putri, $matriks_discordance_putri);

header("location:../index.php?c=" . base64_encode('daftar_nilai') . "&act=" . base64_encode('4'));

?>