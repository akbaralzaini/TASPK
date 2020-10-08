<?php

$sql = "SELECT * FROM peserta WHERE `status` = 0";
$belum_terkonfirmasi = mysqli_query($koneksi, $sql);
$terkonfirmasi = mysqli_query($koneksi, "SELECT * FROM `peserta` WHERE `status` = 1");
$final = mysqli_query($koneksi, "SELECT * FROM `peserta` WHERE `status` = 2");


?>

<div id="content" class="pmd-content inner-page">

	<div class="container-fluid">

		<h1 class="section-title">
			<span>Daftar Peserta</span>
		</h1>

		<ol class="breadcrumb text-left">
			<li><a href="./index.php">Beranda</a></li>
			<li class="active">Daftar Peserta</li>
		</ol>
		<div class="pmd-card pmd-card-default pmd-z-depth" style="margin-top: 20px;margin-bottom:20px">
			<div class="pmd-card-body">
				<a href="./process/hitung_nilai60.php"><button class="btn btn-primary">Hitung 60 Peserta</button></a>
				<a href="./process/hitung_nilai.php"><button class="btn btn-primary">Hitung 30 Peserta</button></a>
			</div>
		</div>

		<div class="no-table-blank-state">
			<?php
			if (isset($_SESSION['msg'])) {
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			} ?>
			<div class="pmd-card pmd-z-depth pmd-card-custom-view">
				<div class="table-responsive">
					<table id="example-checkbox" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Jenis Kelamin</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php

							$no = 0;
							while ($r = mysqli_fetch_array($belum_terkonfirmasi)) {

							?>
								<tr>
									<td><?= ++$no ?></td>
									<td><?= $r['nama'] ?></td>
									<td>
										<?php

										switch ($r['jk']) {
											case 1:
												echo "Laki-laki";
												break;
											case 2:
												echo "Perempuan";
												break;
										}

										?>

									</td>
									<td>
										<a href="./index.php?c=<?= base64_encode('detail_peserta') ?>&act=<?= base64_encode(1) ?>&pid=<?= base64_encode($r['id_peserta']) ?>" class="btn btn-primary" style="background-color: #8f1102;">Detail</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<br>

			<div class="pmd-card pmd-z-depth pmd-card-custom-view">
				<div class="table-responsive">
					<table id="terkonfirmasi" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Jenis Kelamin</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php

							$no = 0;
							while ($r = mysqli_fetch_array($terkonfirmasi)) {

							?>
								<tr>
									<td><?= ++$no ?></td>
									<td><?= $r['nama'] ?></td>
									<td>
										<?php

										switch ($r['jk']) {
											case 1:
												echo "Laki-laki";
												break;
											case 2:
												echo "Perempuan";
												break;
										}

										?>

									</td>
									<td>
										<a href="./index.php?c=<?= base64_encode('detail_peserta') ?>&act=<?= base64_encode(1) ?>&pid=<?= base64_encode($r['id_peserta']) ?>" class="btn btn-primary" style="background-color: #8f1102;">Detail</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="pmd-card pmd-z-depth pmd-card-custom-view">
				<div class="table-responsive">
					<table id="final" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Jenis Kelamin</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php

							$no = 0;
							while ($r = mysqli_fetch_array($final)) {

							?>
								<tr>
									<td><?= ++$no ?></td>
									<td><?= $r['nama'] ?></td>
									<td>
										<?php

										switch ($r['jk']) {
											case 1:
												echo "Laki-laki";
												break;
											case 2:
												echo "Perempuan";
												break;
										}

										?>

									</td>
									<td>
										<a href="./index.php?c=<?= base64_encode('detail_peserta') ?>&act=<?= base64_encode(1) ?>&pid=<?= base64_encode($r['id_peserta']) ?>" class="btn btn-primary" style="background-color: #8f1102;">Detail</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="pmd-card pmd-card-default pmd-z-depth" style="margin-top: 20px;">
				<div class="pmd-card-body">
					<a href="./process/hitung_nilai.php" class="btn btn-primary">Lakukan Perhitungan</a>
				</div>
			</div>
		</div>
	</div>

</div>