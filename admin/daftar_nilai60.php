<?php
//penentuan yang terpilih
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

function map_to_array($jk)
{
	$koneksi = mysqli_connect('localhost', 'root', '', 'db_dina');
	$query = mysqli_query($koneksi, "SELECT * FROM `peserta` WHERE `jk` = " . $jk);
	$ret_arr = [];

	while ($user = mysqli_fetch_array($query)) {
		$queries = mysqli_query($koneksi, "SELECT * FROM `nilai` WHERE `email` = '" . $user['email'] . "' AND (`id_kriteria`=1 or `id_kriteria`=2 or `id_kriteria`=3) ORDER BY `id_kriteria` ASC");
		while ($nilai = mysqli_fetch_array($queries)) {
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

function normalisasi($array)
{
	$tmp_array = $array;
	$ret_array = [];

	foreach ($array as $key => $value) {
		for ($i = 0; $i < count($value); $i++) {
			$tmp_sum = 0;
			foreach ($tmp_array as $v) {
				$tmp_sum += pow(2, $v[$i]);
			}

			$ret_array[$key][] = $value[$i] / sqrt($tmp_sum);
		}
	}

	return $ret_array;
}

function pembobotan($array)
{
	$koneksi = mysqli_connect('localhost', 'root', '', 'db_dina');
	$count = mysqli_query($koneksi, "SELECT `bobot` FROM `kriteria` ORDER BY `id` ASC LIMIT 3");
	$tmp_arr = $array;
	$num = 0;

	while ($bobot = mysqli_fetch_array($count)) {
		foreach ($array as $key => $value) {
			$tmp_arr[$key][$num] = $array[$key][$num] * $bobot['bobot'];
		}

		++$num;
	}

	return $tmp_arr;
}

$kriteria = mysqli_query($koneksi, "SELECT * FROM `kriteria` LIMIT 3");

$nilai_putra = mysqli_query($koneksi, "SELECT * FROM `peserta` WHERE `jk` = 1");
$nilai_putri = mysqli_query($koneksi, "SELECT * FROM `peserta` WHERE `jk` = 2");
$jumlah_putra = $nilai_putra->num_rows;
$jumlah_putri = $nilai_putri->num_rows;

$putra = map_to_array(1);
$putri = map_to_array(2);

$normalisasi_putra = normalisasi($putra);
$normalisasi_putri = normalisasi($putri);

$pembobotan_putra = pembobotan($normalisasi_putra);
$pembobotan_putri = pembobotan($normalisasi_putri);

$concordance_putra = mysqli_query($koneksi, "SELECT * FROM `concordance_matrix` INNER JOIN `peserta` ON `concordance_matrix`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = 1 ORDER BY `concordance_matrix`.`id` ASC");
$concordance_putri = mysqli_query($koneksi, "SELECT * FROM `concordance_matrix` INNER JOIN `peserta` ON `concordance_matrix`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = 2 ORDER BY `concordance_matrix`.`id` ASC");

$discordance_putra = mysqli_query($koneksi, "SELECT * FROM `discordance_matrix` INNER JOIN `peserta` ON `discordance_matrix`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = 1 ORDER BY `discordance_matrix`.`id` ASC");
$discordance_putri = mysqli_query($koneksi, "SELECT * FROM `discordance_matrix` INNER JOIN `peserta` ON `discordance_matrix`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = 2 ORDER BY `discordance_matrix`.`id` ASC");

$concordance_dominan_putra = mysqli_query($koneksi, "SELECT * FROM `concordance_dominan` INNER JOIN `peserta` ON `concordance_dominan`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = 1 ORDER BY `concordance_dominan`.`id` ASC");
$concordance_dominan_putri = mysqli_query($koneksi, "SELECT * FROM `concordance_dominan` INNER JOIN `peserta` ON `concordance_dominan`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = 2 ORDER BY `concordance_dominan`.`id` ASC");

$discordance_dominan_putra = mysqli_query($koneksi, "SELECT * FROM `discordance_dominan` INNER JOIN `peserta` ON `discordance_dominan`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = 1 ORDER BY `discordance_dominan`.`id` ASC");
$discordance_dominan_putri = mysqli_query($koneksi, "SELECT * FROM `discordance_dominan` INNER JOIN `peserta` ON `discordance_dominan`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = 2 ORDER BY `discordance_dominan`.`id` ASC");

$aggregate_dominan_putra = mysqli_query($koneksi, "SELECT * FROM `aggregate_dominan` INNER JOIN `peserta` ON `aggregate_dominan`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = 1 ORDER BY `aggregate_dominan`.`id` ASC");
$aggregate_dominan_putri = mysqli_query($koneksi, "SELECT * FROM `aggregate_dominan` INNER JOIN `peserta` ON `aggregate_dominan`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = 2 ORDER BY `aggregate_dominan`.`id` ASC");

$pemenang_pa = mysqli_query($koneksi, "SELECT * FROM `aggregate_dominan` INNER JOIN `peserta` ON `aggregate_dominan`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = 1 ORDER BY `aggregate_dominan`.`id` ASC");
$pemenang_pi = mysqli_query($koneksi, "SELECT * FROM `aggregate_dominan` INNER JOIN `peserta` ON `aggregate_dominan`.`user` = `peserta`.`email` WHERE `peserta`.`jk` = 2 ORDER BY `aggregate_dominan`.`id` ASC");

$pemenang_putra = pemenang($pemenang_pa);
$pemenang_putri = pemenang($pemenang_pi);

?>

<div id="content" class="pmd-content inner-page">

	<div class="container-fluid">

		<h1 class="section-title">
			<span>Peringkat Peserta</span>
		</h1>

		<ol class="breadcrumb text-left">
			<li><a href="./index.php">Beranda</a></li>
			<li class="active">Peringkat Peserta</li>
		</ol>

		<div class="no-table-blank-state">

			<div class="row">
				<div class="col-md-6">
					<div class="pmd-card pmd-z-depth">
						<div class="pmd-card-title">
							<h2 class="pmd-card-title-text">CEK BAGUS</h2>
						</div>
						<div class="pmd-card-body">
							<p>
								<?php
								$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM `peserta` WHERE `nama` = '" . $pemenang_putra . "'"));
								?>

								<?= $data['nama'] ?>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="pmd-card pmd-z-depth">
						<div class="pmd-card-title">
							<h2 class="pmd-card-title-text">CEK AYU</h2>
						</div>
						<div class="pmd-card-body">
							<p>
								<?php
								$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM `peserta` WHERE `nama` = '" . $pemenang_putri . "'"));
								?>

								<?= $data['nama'] ?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<br>

			<div class="pmd-card pmd-z-depth">
				<div class="pmd-tabs" style="background-color: #8f1102; color:white">
					<div class="pmd-tab-active-bar"></div>
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Nilai Cek Bagus</a></li>
						<li role="presentation"><a href="#about" aria-controls="about" role="tab" data-toggle="tab">Nilai Cek Ayu</a></li>
					</ul>
				</div>
				<div class="pmd-card-body">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="home">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php $krit = [];
											while ($row = mysqli_fetch_array($kriteria)) {
												$krit[] = $row['nama']; ?>
												<th><?= $row['nama'] ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php while ($row = mysqli_fetch_array($nilai_putra)) { ?>
											<tr>
												<td><?= $row['nama'] ?></td>
												<?php
												$sqlputra = mysqli_query($koneksi, "SELECT * FROM `nilai` WHERE `email` = '" . $row['email'] . "'  AND (`id_kriteria`=1 or `id_kriteria`=2 or `id_kriteria`=3) ORDER BY `id` ASC");

												while ($data = mysqli_fetch_array($sqlputra)) { ?>
													<!-- INI YG DIUBAH -->
													<td><?= round($data['nilai']) ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="about">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php foreach ($krit as $k) { ?>
												<th><?= $k ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php while ($row = mysqli_fetch_array($nilai_putri)) { ?>
											<tr>
												<td><?= $row['nama'] ?></td>
												<?php
												$sqlputra = mysqli_query($koneksi, "SELECT * FROM `nilai` WHERE `email` = '" . $row['email'] . "'  AND (`id_kriteria`=1 or `id_kriteria`=2 or `id_kriteria`=3) ORDER BY `id` ASC");

												while ($data = mysqli_fetch_array($sqlputra)) { ?>
													<!-- INI YG DIUBAH -->
													<td><?= round($data['nilai']) ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>

			<div class="pmd-card pmd-z-depth">
				<div class="pmd-tabs" style="background-color: #8f1102; color:white">
					<div class="pmd-tab-active-bar"></div>
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#homes" aria-controls="homes" role="tab" data-toggle="tab">Konversi Nilai Cek Bagus</a></li>
						<li role="presentation"><a href="#abouts" aria-controls="abouts" role="tab" data-toggle="tab">Konversi Nilai Cek Ayu</a></li>
					</ul>
				</div>
				<div class="pmd-card-body">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="homes">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php $no = 0; foreach ($krit as $k) { ?>
												<th><?= 'C'.++$no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; foreach ($putra as $key => $value) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												for ($i = 0; $i < count($value); $i++) { ?>
													<td><?= $value[$i] ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="abouts">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php $no = 0; foreach ($krit as $k) { ?>
												<th><?= 'C'.++$no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; foreach ($putri as $key => $value) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												for ($i = 0; $i < count($value); $i++) { ?>
													<td><?= $value[$i] ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>

			<div class="pmd-card pmd-z-depth">
				<div class="pmd-tabs" style="background-color: #8f1102; color:white">
					<div class="pmd-tab-active-bar"></div>
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#homess" aria-controls="homess" role="tab" data-toggle="tab">(R) Normalisasi Cek Bagus</a></li>
						<li role="presentation"><a href="#aboutss" aria-controls="aboutss" role="tab" data-toggle="tab"> (R) Normalisasi Cek Ayu</a></li>
					</ul>
				</div>
				<div class="pmd-card-body">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="homess">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php $no = 0; foreach ($krit as $k) { ?>
												<th><?= 'C'.++$no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; foreach ($normalisasi_putra as $key => $value) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												for ($i = 0; $i < count($value); $i++) { ?>
													<td><?= number_format((float)$value[$i], 3, '.', ''); ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="aboutss">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php $no = 0; foreach ($krit as $k) { ?>
												<th><?= 'C'.++$no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; foreach ($normalisasi_putri as $key => $value) { ?>
											<tr>
												<td><?= 'R'.++$no ?></td>
												<?php
												for ($i = 0; $i < count($value); $i++) { ?>
													<td><?= number_format((float)$value[$i], 3, '.', ''); ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>

			<div class="pmd-card pmd-z-depth">
				<div class="pmd-tabs" style="background-color: #8f1102; color:white">
					<div class="pmd-tab-active-bar"></div>
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#homesss" aria-controls="homesss" role="tab" data-toggle="tab">(V) Pembobotan Cek Bagus</a></li>
						<li role="presentation"><a href="#aboutsss" aria-controls="aboutsss" role="tab" data-toggle="tab">(V) Pembobotan Cek Ayu</a></li>
					</ul>
				</div>
				<div class="pmd-card-body">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="homesss">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php $no = 0; foreach ($krit as $k) { ?>
												<th><?= 'C'.++$no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; foreach ($pembobotan_putra as $key => $value) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												for ($i = 0; $i < count($value); $i++) { ?>
													<td><?= number_format((float)$value[$i], 3, '.', ''); ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="aboutsss">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php $no = 0; foreach ($krit as $k) { ?>
												<th><?= 'C'.++$no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; foreach ($pembobotan_putri as $key => $value) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												for ($i = 0; $i < count($value); $i++) { ?>
													<td><?= number_format((float)$value[$i], 3, '.', ''); ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>

			<div class="pmd-card pmd-z-depth">
				<div class="pmd-tabs" style="background-color: #8f1102; color:white">
					<div class="pmd-tab-active-bar"></div>
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#homea" aria-controls="homea" role="tab" data-toggle="tab">(CKL) Concordance Cek Bagus</a></li>
						<li role="presentation"><a href="#abouta" aria-controls="abouta" role="tab" data-toggle="tab">(CKL) Concordance Cek Ayu</a></li>
					</ul>
				</div>
				<div class="pmd-card-body">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="homea">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php for($no = 1;$no<=count($krit);$no++) { ?>
												<th><?= $no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; while ($row = mysqli_fetch_array($concordance_putra)) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												$concor = explode(";", $row['nilai']);
												foreach ($concor as $k) { ?>
													<td><?= $k ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="abouta">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php for($no = 1;$no<=count($krit);$no++)  { ?>
												<th><?= $no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; while ($row = mysqli_fetch_array($concordance_putri)) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												$concor = explode(";", $row['nilai']);
												foreach ($concor as $k) { ?>
													<td><?= $k ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>

			<div class="pmd-card pmd-z-depth">
				<div class="pmd-tabs" style="background-color: #8f1102; color:white">
					<div class="pmd-tab-active-bar"></div>
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#homeas" aria-controls="homeas" role="tab" data-toggle="tab">(DKL) Discordance Cek Bagus</a></li>
						<li role="presentation"><a href="#aboutas" aria-controls="aboutas" role="tab" data-toggle="tab">(DKL) Discordance Cek Ayu</a></li>
					</ul>
				</div>
				<div class="pmd-card-body">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="homeas">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php for($no = 1;$no<=count($krit);$no++)  { ?>
												<th><?= $no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0;
										 while ($row = mysqli_fetch_array($discordance_putra)) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												$concor = explode(";", $row['nilai']);
												foreach ($concor as $k) { ?>
													<td><?= $k ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="aboutas">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php 
											for($no = 1;$no<=count($krit);$no++)  { ?>
												<th><?= ++$no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; while ($row = mysqli_fetch_array($discordance_putri)) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												$concor = explode(";", $row['nilai']);
												foreach ($concor as $k) { ?>
													<td><?= number_format((float)$k, 3, '.', ''); ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>

			<div class="pmd-card pmd-z-depth">
				<div class="pmd-tabs" style="background-color: #8f1102; color:white">
					<div class="pmd-tab-active-bar"></div>
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#homeaq" aria-controls="homeaq" role="tab" data-toggle="tab">(F) Dominan Concordance Cek Bagus</a></li>
						<li role="presentation"><a href="#aboutaq" aria-controls="aboutaq" role="tab" data-toggle="tab">(F) Dominan Concordance Cek Ayu</a></li>
					</ul>
				</div>
				<div class="pmd-card-body">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="homeaq">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php for($no = 1;$no<=count($krit);$no++) { ?>
												<th><?= $no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; while ($row = mysqli_fetch_array($concordance_dominan_putra)) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												$concor = explode(";", $row['nilai']);
												foreach ($concor as $k) { ?>
													<td><?= $k ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="aboutaq">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php for($no = 1;$no<=count($krit);$no++)  { ?>
												<th><?= $no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; while ($row = mysqli_fetch_array($concordance_dominan_putri)) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												$concor = explode(";", $row['nilai']);
												foreach ($concor as $k) { ?>
													<td><?= $k ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>

			<div class="pmd-card pmd-z-depth">
				<div class="pmd-tabs" style="background-color: #8f1102; color:white">
					<div class="pmd-tab-active-bar"></div>
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#homeaw" aria-controls="homeaw" role="tab" data-toggle="tab">(G) Dominan Discordance Cek Bagus</a></li>
						<li role="presentation"><a href="#abouta2" aria-controls="abouta2" role="tab" data-toggle="tab">(G) Dominan Discordance Cek Ayu</a></li>
					</ul>
				</div>
				<div class="pmd-card-body">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="homeaw">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php for($no = 1;$no<=count($krit);$no++)  { ?>
												<th><?= $no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; while ($row = mysqli_fetch_array($discordance_dominan_putra)) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												$concor = explode(";", $row['nilai']);
												foreach ($concor as $k) { ?>
													<td><?= $k ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="abouta2">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php for($no = 1;$no<=count($krit);$no++)  { ?>
												<th><?= $no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; while ($row = mysqli_fetch_array($discordance_dominan_putri)) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												$concor = explode(";", $row['nilai']);
												foreach ($concor as $k) { ?>
													<td><?= $k ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>

			<div class="pmd-card pmd-z-depth">
				<div class="pmd-tabs" style="background-color: #8f1102; color:white">
					<div class="pmd-tab-active-bar"></div>
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#homeal" aria-controls="homeal" role="tab" data-toggle="tab">(E) Aggregate Dominan Cek Bagus</a></li>
						<li role="presentation"><a href="#aboutal" aria-controls="aboutal" role="tab" data-toggle="tab">(E) Aggregate Dominan Cek Ayu</a></li>
					</ul>
				</div>
				<div class="pmd-card-body">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="homeal">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php for($no = 1;$no<=count($krit);$no++)  { ?>
												<th><?= $no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; while ($row = mysqli_fetch_array($aggregate_dominan_putra)) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												$concor = explode(";", $row['nilai']);
												foreach ($concor as $k) { ?>
													<td><?= $k ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="aboutal">
							<div class="table-responsive">
								<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Nama</th>
											<?php for($no = 1;$no<count($krit);$no++)  { ?>
												<th><?= $no ?></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no = 0; while ($row = mysqli_fetch_array($aggregate_dominan_putri)) { ?>
											<tr>
												<td><?= 'A'.++$no ?></td>
												<?php
												$concor = explode(";", $row['nilai']);
												foreach ($concor as $k) { ?>
													<td><?= $k ?></td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<a href="./cetak_laporan.php" class="btn btn-success pmd-z-depth waves-effect" style="width:100%; margin-bottom: 20px; background-color: #8f1102;">CETAK BERITA ACARA PDF</a>

		</div>
	</div>

</div>