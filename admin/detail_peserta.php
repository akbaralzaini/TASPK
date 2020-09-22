<?php

include '../config/koneksi.php';

$id = base64_decode($_GET['pid']);

$sql = "SELECT * FROM peserta WHERE id_peserta = " . $id;
$query = mysqli_query($koneksi, $sql);
$data_pribadi = mysqli_fetch_assoc($query);

$data_orangtua = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM `data_orangtua` WHERE `email` = '" . $data_pribadi['email'] . "'"));

?>

<div id="content" class="pmd-content pmd-content-custom">

	<div class="container-fluid full-width-container blank">
		<h1 class="section-title">
			<span>Detail Peserta</span>
		</h1>

		<ol class="breadcrumb text-left">
			<li><a href="./index.php">Beranda</a></li>
			<li><a href="./index.php?c=<?= base64_encode('daftar_peserta') ?>&act=<?= base64_encode('1') ?>">Daftar Peserta</a></li>
			<li class="active"><?= $data_pribadi['nama'] ?></li>
		</ol>

		<div class="row">
			<div class="col-md-3">
				<div class="pmd-card pmd-card-default pmd-z-depth">
					<div class="pmd-card-media">
						<?php if ($data_pribadi['foto'] == null) {  ?>
							<center><img src="../assets/img/user-icon.png" alt="New User"></center>
						<?php } else { ?>
							<img src="../user/process/foto_peserta/<?= $data_pribadi['foto'] ?>" class="img-responsive" alt="New User">
						<?php } ?>
					</div>
					<div class="pmd-card-title">
						<h2 class="pmd-card-title-text"><?= $data_pribadi['nama'] ?></h2>
						<span class="pmd-card-subtitle-text"><?= $data_pribadi['panggilan'] ?></span>
					</div>
				</div>
				<br>

				<a href="./download.php?id=<?= base64_encode($data_pribadi['berkas']) ?>&id_peserta=<?= $data_pribadi['id_peserta'] ?>" class="btn btn-success pmd-z-depth waves-effect" style="width:100%; margin-bottom: 10px; background-color: #8f1102;">Download Berkas</a>

				<?php if ($data_pribadi['status'] == 0) { ?>
					<a href="./process/lolos_admin.php?id=<?= base64_encode($data_pribadi['email']) ?>" class="btn btn-success pmd-z-depth waves-effect" style="width:100%; margin-bottom: 10px; background-color: #8f1102;">Lolos Administrasi</a>
				<?php } ?>

				<?php if ($data_pribadi['status'] == 1) { ?>
					<a href="./process/lolos_final.php?id=<?= base64_encode($data_pribadi['email']) ?>" class="btn btn-success pmd-z-depth waves-effect" style="width:100%; margin-bottom: 10px; background-color: #8f1102;">Lolos Final</a>
				<?php } ?>

			</div>

			<div class="col-md-9">
				<div class="pmd-card pmd-z-depth">
					<div class="pmd-tabs" style="background-color: #8f1102; color:white">
						<div class="pmd-tab-active-bar"></div>
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#homeal" aria-controls="homeal" role="tab" data-toggle="tab">Data Pribadi</a></li>
							<li role="presentation"><a href="#aboutal" aria-controls="aboutal" role="tab" data-toggle="tab">Data Orang Tua</a></li>
							<li role="presentation"><a href="#aboutals" aria-controls="aboutals" role="tab" data-toggle="tab">Data Akademik &amp; Prestasi</a></li>
						</ul>
					</div>
					<div class="pmd-card-body">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="homeal">
								<div class="group-fields clearfix row">

									<div class="form-group col-lg-6 col-md-12 col-sm-12 pmd-textfield pmd-textfield-floating-label">
										<label for="tgl" class="control-label">Tempat Lahir</label>
										<input type="text" name="tempat" value="<?= $data_pribadi['tempat'] ?>" class="form-control" id="tgl">
										<span class="pmd-textfield-focused"></span>
									</div>

									<div class="form-group col-lg-6 col-md-12 col-sm-12 pmd-textfield pmd-textfield-floating-label">
										<label for="regular1" class="control-label">Tanggal Lahir</label>
										<input type="text" name="tgl" value="<?= $data_pribadi['tgl_lhr'] ?>" id="datetimepicker-default" class="form-control" />
										<span class="pmd-textfield-focused"></span>
									</div>
								</div>


								<div class="form-group pmd-textfield pmd-textfield-floating-label">
									<label>Jenis Kelamin</label>
									<select name="jk" class="select-simple form-control pmd-select2">
										<option>Pilih Jenis Kelamin</option>
										<option <?php if ($data_pribadi['jk'] == 1) {
													echo "selected";
												} ?> value="1">Laki - laki</option>
										<option <?php if ($data_pribadi['jk'] == 2) {
													echo "selected";
												} ?> value="2">Perempuan</option>
									</select>
								</div>

								<div class="form-group pmd-textfield pmd-textfield-floating-label">
									<label for="agama" class="control-label">Pekerjaan</label>
									<input type="text" name="pekerjaan" value="<?= $data_pribadi['pekerjaan'] ?>" class="form-control" id="agama">
									<span class="pmd-textfield-focused"></span>
								</div>

								<div class="form-group pmd-textfield pmd-textfield-floating-label">
									<label>Agama</label>
									<select name="agama" class="select-simple form-control pmd-select2">
										<option>Pilih Agama</option>
										<option <?php if ($data_pribadi['agama'] == 1) {
													echo "selected";
												} ?> value="1">Islam</option>
										<option <?php if ($data_pribadi['agama'] == 2) {
													echo "selected";
												} ?> value="2">Kristen</option>
										<option <?php if ($data_pribadi['agama'] == 3) {
													echo "selected";
												} ?> value="3">Protestan</option>
										<option <?php if ($data_pribadi['agama'] == 4) {
													echo "selected";
												} ?> value="4">Hindu</option>
										<option <?php if ($data_pribadi['agama'] == 5) {
													echo "selected";
												} ?> value="5">Budha</option>
										<option <?php if ($data_pribadi['agama'] == 6) {
													echo "selected";
												} ?> value="6">Konghucu</option>
									</select>
								</div>

								<div class="form-group pmd-textfield pmd-textfield-floating-label">
									<label for="agama" class="control-label">Alamat</label>
									<textarea name="alamat" id="" cols="30" rows="10" class="form-control"><?= $data_pribadi['alamat'] ?></textarea>
								</div>

								<div class="group-fields clearfix row">

									<div class="form-group col-lg-4 pmd-textfield pmd-textfield-floating-label">
										<label for="agama" class="control-label">Whatsapp</label>
										<input type="text" name="wa" value="<?= $data_pribadi['nomor'] ?>" class="form-control" id="agama">
										<span class="pmd-textfield-focused"></span>
									</div>

									<div class="form-group col-lg-4 pmd-textfield pmd-textfield-floating-label">
										<label for="agama" class="control-label">Instagram</label>
										<input type="text" name="ig" value="<?= $data_pribadi['instagram'] ?>" class="form-control" id="agama">
										<span class="pmd-textfield-focused"></span>
									</div>

									<div class="form-group col-lg-4 pmd-textfield pmd-textfield-floating-label">
										<label for="agama" class="control-label">ID Line</label>
										<input type="text" name="line" value="<?= $data_pribadi['line'] ?>" class="form-control" id="agama">
										<span class="pmd-textfield-focused"></span>
									</div>
								</div>

								<div class="form-group pmd-textfield pmd-textfield-floating-label">
									<label for="agama" class="control-label">Email</label>
									<input type="text" name="email" value="<?= $data_pribadi['email'] ?>" class="form-control" id="agama">
									<span class="pmd-textfield-focused"></span>
								</div>

								<div class="group-fields clearfix row">
									<div class="form-group col-lg-6 pmd-textfield pmd-textfield-floating-label">
										<label for="agama" class="control-label">Tinggi Badan</label>
										<input type="number" name="tb" value="<?= $data_pribadi['tb'] ?>" class="form-control" id="agama">
										<p class="help-block">*) Dalam Centimeter</p>
									</div>

									<div class="form-group col-lg-6 pmd-textfield pmd-textfield-floating-label">
										<label for="agama" class="control-label">Berat Badan</label>
										<input type="number" name="bb" value="<?= $data_pribadi['bb'] ?>" class="form-control" id="agama">
										<p class="help-block">*) Dalam Kilogram</p>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="aboutal">
								<div class="row">
									<div class="col-lg-6 col-md-12 col-sm-12">
										<div class="form-group pmd-textfield pmd-textfield-floating-label">
											<label for="tgl" class="control-label">Nama Ayah</label>
											<input type="text" name="tempat" value="<?= $data_orangtua['nama_ayah'] ?>" class="form-control" id="tgl">
											<span class="pmd-textfield-focused"></span>
										</div>

										<div class="form-group pmd-textfield pmd-textfield-floating-label">
											<label for="tgl" class="control-label">Pekerjaan Ayah</label>
											<input type="text" name="tempat" value="<?= $data_orangtua['pekerjaan_ayah'] ?>" class="form-control" id="tgl">
											<span class="pmd-textfield-focused"></span>
										</div>

										<div class="form-group pmd-textfield pmd-textfield-floating-label">
											<label for="tgl" class="control-label">Nomor HP Ayah</label>
											<input type="text" name="tempat" value="<?= $data_orangtua['hp_ayah'] ?>" class="form-control" id="tgl">
											<span class="pmd-textfield-focused"></span>
										</div>
									</div>

									<div class="col-lg-6 col-md-12 col-sm-12">
										<div class="form-group pmd-textfield pmd-textfield-floating-label">
											<label for="tgl" class="control-label">Nama Ibu</label>
											<input type="text" name="tempat" value="<?= $data_orangtua['nama_ibu'] ?>" class="form-control" id="tgl">
											<span class="pmd-textfield-focused"></span>
										</div>

										<div class="form-group pmd-textfield pmd-textfield-floating-label">
											<label for="tgl" class="control-label">Pekerjaan Ibu</label>
											<input type="text" name="tempat" value="<?= $data_orangtua['pekerjaan_ibu'] ?>" class="form-control" id="tgl">
											<span class="pmd-textfield-focused"></span>
										</div>

										<div class="form-group pmd-textfield pmd-textfield-floating-label">
											<label for="tgl" class="control-label">Nomor HP Ibu</label>
											<input type="text" name="tempat" value="<?= $data_orangtua['hp_ibu'] ?>" class="form-control" id="tgl">
											<span class="pmd-textfield-focused"></span>
										</div>
									</div>

								</div>
							</div>

							<div role="tabpanel" class="tab-pane" id="aboutals">
								<div class="pmd-card pmd-card-default pmd-z-depth" style="margin-bottom: 20px">
									<div class="pmd-card-title">
										<h2 class="pmd-card-title-text">
											Pendidikan Formal
										</h2>
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
													</tr>
												</thead>
												<tbody>
													<?php

													$data_pendidikan = mysqli_query($koneksi, "SELECT * FROM `pendidikan_prestasi` WHERE `tipe` = 1 AND `email` = '" . $data_pribadi['email'] . "'");
													$no = 0;
													while ($row = mysqli_fetch_array($data_pendidikan)) {
														$data = explode(';', $row['isi']);
													?>
														<tr>
															<td><?= ++$no ?></td>
															<td><?= $data[0] ?></td>
															<td><?= $data[1] ?></td>
															<td><?= $data[2] ?></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<div class="pmd-card pmd-card-default pmd-z-depth" style="margin-bottom: 20px">
									<div class="pmd-card-title">
										<h2 class="pmd-card-title-text">
											Pengalaman Bekerja
										</h2>
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
													</tr>
												</thead>
												<tbody>
													<?php

													$data_pekerjaan = mysqli_query($koneksi, "SELECT * FROM `pendidikan_prestasi` WHERE `tipe` = 2 AND `email` = '" . $data_pribadi['email'] . "'");
													$no = 0;
													while ($row = mysqli_fetch_array($data_pekerjaan)) {
														$data = explode(';', $row['isi']);
													?>
														<tr>
															<td><?= ++$no ?></td>
															<td><?= $data[0] ?></td>
															<td><?= $data[1] ?></td>
															<td><?= $data[2] ?></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<div class="pmd-card pmd-card-default pmd-z-depth" style="margin-bottom: 20px">
									<div class="pmd-card-title">
										<h2 class="pmd-card-title-text">
											Riwayat Organisasi
										</h2>
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
													</tr>
												</thead>
												<tbody>
													<?php

													$data_organisasi = mysqli_query($koneksi, "SELECT * FROM `pendidikan_prestasi` WHERE `tipe` = 3 AND `email` = '" . $data_pribadi['email'] . "'");
													$no = 0;
													while ($row = mysqli_fetch_array($data_organisasi)) {
														$data = explode(';', $row['isi']);
													?>
														<tr>
															<td><?= ++$no ?></td>
															<td><?= $data[0] ?></td>
															<td><?= $data[1] ?></td>
															<td><?= $data[2] ?></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>

									</div>
								</div>

								<div class="pmd-card pmd-card-default pmd-z-depth">
									<div class="pmd-card-title">
										<h2 class="pmd-card-title-text">
											Prestasi
										</h2>
									</div>
									<div class="pmd-card-body">
										<div class="table-responsive">
											<table class="table table-mc-red pmd-table">
												<thead>
													<tr>
														<td>No.</td>
														<td>Prestasi</td>
														<td>Tahun</td>
													</tr>
												</thead>
												<tbody>
													<?php

													$data_prestasi = mysqli_query($koneksi, "SELECT * FROM `pendidikan_prestasi` WHERE `tipe` = 4 AND `email` = '" . $data_pribadi['email'] . "'");
													$no = 0;
													while ($row = mysqli_fetch_array($data_prestasi)) {
														$data = explode(';', $row['isi']);
													?>
														<tr>
															<td><?= ++$no ?></td>
															<td><?= $data[0] ?></td>
															<td><?= $data[1] ?></td>
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
				</div>

			</div>

		</div>
	</div>
</div>