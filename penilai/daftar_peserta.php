<?php

$sql = "SELECT * FROM `nilai` INNER JOIN `peserta` ON `nilai`.`email` = `peserta`.`email` WHERE `nilai`.`id_kriteria` = '".$_SESSION['penilai']['id_kriteria']."'";
$belum_terkonfirmasi = mysqli_query($koneksi, $sql);

?>

<div id="content" class="pmd-content inner-page">

	<div class="container-fluid full-width-container blank">

		<h1 class="section-title">
			<span>Daftar Peserta</span>
		</h1>

		<ol class="breadcrumb text-left">
			<li><a href="./index.php">Beranda</a></li>
			<li class="active">Daftar Peserta</li>
		</ol>

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
		</div>
	</div>

</div>