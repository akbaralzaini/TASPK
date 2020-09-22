<div id="content" class="pmd-content inner-page">

	<div class="container-fluid">

		<h1 class="section-title">
			<span>Formulir Data Pendidikan &amp; Prestasi</span>
		</h1>

		<ol class="breadcrumb text-left">
			<li><a href="">Beranda</a></li>
			<li class="active">Formulir Data Pendidikan &amp; Prestasi</li>
		</ol>

		<div class="no-table-blank-state">
			<?php
			if (isset($_SESSION['msg'])) {
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			} ?>
			<div class="pmd-card pmd-card-default pmd-z-depth" style="margin-bottom: 20px">
				<div class="pmd-card-title">
					<button style="float: right; background-color: #4682B4;" data-target="#pendidikan_formal" data-toggle="modal" class="btn-sm btn pmd-btn-fab btn-primary pmd-ripple-effect">
						<i class="material-icons">add</i>
					</button>
					<div tabindex="-1" class="modal fade" id="pendidikan_formal" style="display: none;" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h2 class="pmd-card-title-text">Tambah Pendidikan Formal</h2>
								</div>
								<form action="./process/input_prestasi.php" method="post">
									<input type="hidden" name="tipe" value="1">
									<div class="modal-body">
										<div class="form-group pmd-textfield">
											<label for="namal" class="control-label">Sekolah / Universitas</label>
											<input type="text" name="satu" class="form-control" id="namal" required>
											<span class="pmd-textfield-focused"></span>
										</div>

										<div class="form-group pmd-textfield">
											<label for="namal" class="control-label">Tahun Masuk</label>
											<input type="text" name="dua" class="form-control thn" id="thn" required>
											<span class="pmd-textfield-focused"></span>
										</div>
										<div class="form-group pmd-textfield">
											<label for="namal" class="control-label">Tahun Keluar</label>
											<input type="text" name="tiga" class="form-control thn" id="thn" required>
											<span class="pmd-textfield-focused"></span>
										</div>
									</div>
									<div class="pmd-modal-action pmd-modal-bordered text-right">
										<button type="submit" class="btn pmd-btn-flat pmd-ripple-effect btn-primary">Simpan</button>
										<button data-dismiss="modal" class="btn pmd-btn-flat pmd-ripple-effect btn-danger" type="button">Batal</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<h2 class="pmd-card-title-text">
						Pendidikan Formal
					</h2>
					<p class="pmd-card-subtitle-text">
						*) SD / SMP / SMA dst
					</p>
				</div>
				<div class="pmd-card-body">
					<div class="table-responsive">
						<table class="table table-mc-red pmd-table">
							<thead>
								<tr>
									<td>No.</td>
									<td>Sekolah / Universitas</td>
									<td>Tahun Masuk</td>
									<td>Tahun Keluar</td>
									<td>Opsi</td>
								</tr>
							</thead>
							<tbody>
								<?php

								$data_pendidikan = mysqli_query($koneksi, "SELECT * FROM `pendidikan_prestasi` WHERE `tipe` = 1 AND `email` = '" . $_SESSION['username'] . "'");
								$no = 0;
								while ($row = mysqli_fetch_array($data_pendidikan)) {
									$data = explode(';', $row['isi']);
								?>
									<tr>
										<td><?= ++$no ?></td>
										<td><?= $data[0] ?></td>
										<td><?= $data[1] ?></td>
										<td><?= $data[2] ?></td>
										<td>
											<a href="./process/hapus_pendidikan_prestasi.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-danger pmd-ripple-effect pmd-btn-fab btn-sm"><i class="material-icons">delete</i></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="pmd-card pmd-card-default pmd-z-depth" style="margin-bottom: 20px">
				<div class="pmd-card-title">
					<button style="float: right; background-color: #4682B4;" data-target="#pekerjaan" data-toggle="modal" class="btn-sm btn pmd-btn-fab btn-primary pmd-ripple-effect">
						<i class="material-icons">add</i>
					</button>
					<div tabindex="-1" class="modal fade" id="pekerjaan" style="display: none;" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h2 class="pmd-card-title-text">Tambah Pekerjaan</h2>
								</div>
								<form action="./process/input_prestasi.php" method="post">
									<input type="hidden" name="tipe" value="2">
									<div class="modal-body">
										<div class="form-group pmd-textfield">
											<label for="namal" class="control-label">Instansi</label>
											<input type="text" name="satu" class="form-control" id="namal" required>
											<span class="pmd-textfield-focused"></span>
										</div>

										<div class="form-group pmd-textfield">
											<label for="namal" class="control-label">Bagian</label>
											<input type="text" name="dua" class="form-control" required>
											<span class="pmd-textfield-focused"></span>
										</div>
										<div class="form-group pmd-textfield">
											<label for="namal" class="control-label">Tahun</label>
											<input type="text" name="tiga" class="form-control thn" id="thn" required>
											<span class="pmd-textfield-focused"></span>
										</div>
									</div>
									<div class="pmd-modal-action pmd-modal-bordered text-right">
										<button type="submit" class="btn pmd-btn-flat pmd-ripple-effect btn-primary">Simpan</button>
										<button data-dismiss="modal" class="btn pmd-btn-flat pmd-ripple-effect btn-danger" type="button">Batal</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<h2 class="pmd-card-title-text">
						Pengalaman Bekerja
					</h2>
					<p class="pmd-card-subtitle-text">
						*) Wajib diisi apabila sudah bekerja
					</p>
				</div>
				<div class="pmd-card-body">
					<div class="table-responsive">
						<table class="table table-mc-red pmd-table">
							<thead>
								<tr>
									<td>No.</td>
									<td>Instansi</td>
									<td>Bagian</td>
									<td>Tahun</td>
									<td>Opsi</td>
								</tr>
							</thead>
							<tbody>
								<?php

								$data_pekerjaan = mysqli_query($koneksi, "SELECT * FROM `pendidikan_prestasi` WHERE `tipe` = 2 AND `email` = '" . $_SESSION['username'] . "'");
								$no = 0;
								while ($row = mysqli_fetch_array($data_pekerjaan)) {
									$data = explode(';', $row['isi']);
								?>
									<tr>
										<td><?= ++$no ?></td>
										<td><?= $data[0] ?></td>
										<td><?= $data[1] ?></td>
										<td><?= $data[2] ?></td>
										<td>
											<a href="./process/hapus_pendidikan_prestasi.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-danger pmd-ripple-effect pmd-btn-fab btn-sm"><i class="material-icons">delete</i></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="pmd-card pmd-card-default pmd-z-depth" style="margin-bottom: 20px">
				<div class="pmd-card-title">
					<button style="float: right; background-color: #4682B4;" data-target="#organisasi" data-toggle="modal" class="btn-sm btn pmd-btn-fab btn-primary pmd-ripple-effect">
						<i class="material-icons">add</i>
					</button>
					<div tabindex="-1" class="modal fade" id="organisasi" style="display: none;" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h2 class="pmd-card-title-text">Tambah Pekerjaan</h2>
								</div>
								<form action="./process/input_prestasi.php" method="post">
									<input type="hidden" name="tipe" value="3">
									<div class="modal-body">
										<div class="form-group pmd-textfield">
											<label for="namal" class="control-label">Nama Organisasi / Komunitas</label>
											<input type="text" name="satu" class="form-control" id="namal" required>
											<span class="pmd-textfield-focused"></span>
										</div>

										<div class="form-group pmd-textfield">
											<label for="namal" class="control-label">Jabatan</label>
											<input type="text" name="dua" class="form-control" required>
											<span class="pmd-textfield-focused"></span>
										</div>
										<div class="form-group pmd-textfield">
											<label for="namal" class="control-label">Tahun</label>
											<input type="text" name="tiga" class="form-control thn" id="thn" required>
											<span class="pmd-textfield-focused"></span>
										</div>
									</div>
									<div class="pmd-modal-action pmd-modal-bordered text-right">
										<button type="submit" class="btn pmd-btn-flat pmd-ripple-effect btn-primary">Simpan</button>
										<button data-dismiss="modal" class="btn pmd-btn-flat pmd-ripple-effect btn-danger" type="button">Batal</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<h2 class="pmd-card-title-text">
						Riwayat Organisasi
					</h2>
					<p class="pmd-card-subtitle-text">
						*) Organisasi / Komunitas
					</p>
				</div>
				<div class="pmd-card-body">
					<div class="table-responsive">
						<table class="table table-mc-red pmd-table">
							<thead>
								<tr>
									<td>No.</td>
									<td>Instansi</td>
									<td>Bagian</td>
									<td>Tahun</td>
									<td>Opsi</td>
								</tr>
							</thead>
							<tbody>
								<?php

								$data_organisasi = mysqli_query($koneksi, "SELECT * FROM `pendidikan_prestasi` WHERE `tipe` = 3 AND `email` = '" . $_SESSION['username'] . "'");
								$no = 0;
								while ($row = mysqli_fetch_array($data_organisasi)) {
									$data = explode(';', $row['isi']);
								?>
									<tr>
										<td><?= ++$no ?></td>
										<td><?= $data[0] ?></td>
										<td><?= $data[1] ?></td>
										<td><?= $data[2] ?></td>
										<td>
											<a href="./process/hapus_pendidikan_prestasi.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-danger pmd-ripple-effect pmd-btn-fab btn-sm"><i class="material-icons">delete</i></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>

				</div>
			</div>

			<div class="pmd-card pmd-card-default pmd-z-depth">
				<div class="pmd-card-title">
					<button style="float: right; background-color: #4682B4;" data-target="#prestasi" data-toggle="modal" class="btn-sm btn pmd-btn-fab btn-primary pmd-ripple-effect">
						<i class="material-icons">add</i>
					</button>
					<div tabindex="-1" class="modal fade" id="prestasi" style="display: none;" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h2 class="pmd-card-title-text">Tambah Pekerjaan</h2>
								</div>
								<form action="./process/input_prestasi.php" method="post">
									<input type="hidden" name="tipe" value="4">
									<div class="modal-body">
										<div class="form-group pmd-textfield">
											<label for="namal" class="control-label">Prestasi</label>
											<input type="text" name="prestasi" class="form-control" id="namal" required>
											<span class="pmd-textfield-focused"></span>
										</div>
										<div class="form-group pmd-textfield">
											<label for="namal" class="control-label">Tahun</label>
											<input type="text" name="tahun" class="form-control thn" id="thn" required>
											<span class="pmd-textfield-focused"></span>
										</div>
									</div>
									<div class="pmd-modal-action pmd-modal-bordered text-right">
										<button type="submit" class="btn pmd-btn-flat pmd-ripple-effect btn-primary">Simpan</button>
										<button data-dismiss="modal" class="btn pmd-btn-flat pmd-ripple-effect btn-danger" type="button">Batal</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<h2 class="pmd-card-title-text">
						Prestasi
					</h2>
					<p class="pmd-card-subtitle-text">
						*) Wajib melampirkan sertifikat saat upload berkas
					</p>
				</div>
				<div class="pmd-card-body">
					<div class="table-responsive">
						<table class="table table-mc-red pmd-table">
							<thead>
								<tr>
									<td>No.</td>
									<td>Prestasi</td>
									<td>Tahun</td>
									<td>Opsi</td>
								</tr>
							</thead>
							<tbody>
								<?php

								$data_prestasi = mysqli_query($koneksi, "SELECT * FROM `pendidikan_prestasi` WHERE `tipe` = 4 AND `email` = '" . $_SESSION['username'] . "'");
								$no = 0;
								while ($row = mysqli_fetch_array($data_prestasi)) {
									$data = explode(';', $row['isi']);
								?>
									<tr>
										<td><?= ++$no ?></td>
										<td><?= $data[0] ?></td>
										<td><?= $data[1] ?></td>
										<td>
											<a href="./process/hapus_pendidikan_prestasi.php?id=<?= base64_encode($row['id']) ?>" class="btn btn-danger pmd-ripple-effect pmd-btn-fab btn-sm"><i class="material-icons">delete</i></a>
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

</div>