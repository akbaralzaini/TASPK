<?php

$sql = "SELECT * FROM peserta WHERE email = '" . $_SESSION['username'] . "'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($query);

?>

<div id="content" class="pmd-content inner-page">

	<div class="container-fluid full-width-container blank">

		<h1 class="section-title">
			<span>Formulir Data Diri</span>
		</h1>

		<ol class="breadcrumb text-left">
			<li><a href="" style="color: #4682B4">Beranda</a></li>
			<li class="active">Formulir Data Diri</li>
		</ol>

		<div class="no-table-blank-state">
			<form action="./process/input_data_diri.php" method="POST" enctype="multipart/form-data">
				<div class="pmd-card pmd-card-default pmd-z-depth" style="margin-bottom: 20px; ">
					<div class="pmd-card-title" style="background-color: #4682B4; color: white;">
						<h2 class="pmd-card-title-text" style="margin-bottom: 15px;">
							<i class="material-icons">content_paste</i> Data Personal
						</h2>
					</div>
					<div class="pmd-card-body">
						<div class="group-fields clearfix row">
							<div class="form-group col-lg-6 col-md-12 col-sm-12">
								<label for="">Input Foto Anda</label>
								<input type="file" name="files">
							</div>
							<div class="form-group col-lg-6 col-md-12 col-sm-12 pmd-textfield pmd-textfield-floating-label">
								<label for="namal" class="control-label">Nama Lengkap</label>
								<input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control" id="namal">
								<span class="pmd-textfield-focused"></span>
							</div>

							<div class="form-group col-lg-6 col-md-12 col-sm-12 pmd-textfield pmd-textfield-floating-label">
								<label for="namap" class="control-label">Nama Panggilan</label>
								<input type="text" name="panggilan" value="<?= $data['panggilan'] ?>" class="form-control" id="namap">
								<span class="pmd-textfield-focused"></span>
							</div>

							<div class="form-group col-lg-6 col-md-12 col-sm-12 pmd-textfield pmd-textfield-floating-label">
								<label for="tgl" class="control-label">Tempat Lahir</label>
								<input type="text" name="tempat" value="<?= $data['tempat'] ?>" class="form-control" id="tgl">
								<span class="pmd-textfield-focused"></span>
							</div>

							<div class="form-group col-lg-6 col-md-12 col-sm-12 pmd-textfield pmd-textfield-floating-label">
								<label for="regular1" class="control-label">Tanggal Lahir</label>
								<input type="text" name="tgl" value="<?= $data['tgl_lhr'] ?>" id="datetimepicker-default" class="form-control" />
								<span class="pmd-textfield-focused"></span>
							</div>
							<div class="form-group col-lg-6 col-md-12 col-sm-12 pmd-textfield pmd-textfield-floating-label">
								<label>Jenis Kelamin</label>
								<select name="jk" class="select-simple form-control pmd-select2">
									<option>Pilih Jenis Kelamin</option>
									<option <?php if ($data['jk'] == 1) {
												echo "selected";
											} ?> value="1">Laki - laki</option>
									<option <?php if ($data['jk'] == 2) {
												echo "selected";
											} ?> value="2">Perempuan</option>
								</select>
							</div>
						</div>



						<div class="form-group pmd-textfield pmd-textfield-floating-label">
							<label for="agama" class="control-label">Pekerjaan</label>
							<input type="text" name="pekerjaan" value="<?= $data['pekerjaan'] ?>" class="form-control" id="agama">
							<span class="pmd-textfield-focused"></span>
						</div>

						<div class="form-group pmd-textfield pmd-textfield-floating-label">
							<label>Agama</label>
							<select name="agama" class="select-simple form-control pmd-select2">
								<option>Pilih Agama</option>
								<option <?php if ($data['agama'] == 1) {
											echo "selected";
										} ?> value="1">Islam</option>
								<option <?php if ($data['agama'] == 2) {
											echo "selected";
										} ?> value="2">Kristen</option>
								<option <?php if ($data['agama'] == 3) {
											echo "selected";
										} ?> value="3">Protestan</option>
								<option <?php if ($data['agama'] == 4) {
											echo "selected";
										} ?> value="4">Hindu</option>
								<option <?php if ($data['agama'] == 5) {
											echo "selected";
										} ?> value="5">Budha</option>
								<option <?php if ($data['agama'] == 6) {
											echo "selected";
										} ?> value="6">Konghucu</option>
							</select>
						</div>

						<div class="form-group pmd-textfield pmd-textfield-floating-label">
							<label for="agama" class="control-label">Alamat</label>
							<textarea name="alamat" id="" cols="30" rows="10" class="form-control"><?= $data['alamat'] ?></textarea>
						</div>

						<div class="group-fields clearfix row">

							<div class="form-group col-lg-4 pmd-textfield pmd-textfield-floating-label">
								<label for="agama" class="control-label">Whatsapp</label>
								<input type="text" name="wa" value="<?= $data['nomor'] ?>" class="form-control" id="agama">
								<span class="pmd-textfield-focused"></span>
							</div>

							<div class="form-group col-lg-4 pmd-textfield pmd-textfield-floating-label">
								<label for="agama" class="control-label">Instagram</label>
								<input type="text" name="ig" value="<?= $data['instagram'] ?>" class="form-control" id="agama">
								<span class="pmd-textfield-focused"></span>
							</div>

							<div class="form-group col-lg-4 pmd-textfield pmd-textfield-floating-label">
								<label for="agama" class="control-label">ID Line</label>
								<input type="text" name="line" value="<?= $data['line'] ?>" class="form-control" id="agama">
								<span class="pmd-textfield-focused"></span>
							</div>
						</div>

						<div class="form-group pmd-textfield pmd-textfield-floating-label">
							<label for="agama" class="control-label">Email</label>
							<input type="text" name="email" value="<?= $data['email'] ?>" class="form-control" id="agama">
							<span class="pmd-textfield-focused"></span>
						</div>

						<div class="group-fields clearfix row">
							<div class="form-group col-lg-6 pmd-textfield pmd-textfield-floating-label">
								<label for="agama" class="control-label">Tinggi Badan</label>
								<input type="number" name="tb" value="<?= $data['tb'] ?>" class="form-control" id="agama">
								<p class="help-block">*) Dalam Centimeter</p>
							</div>

							<div class="form-group col-lg-6 pmd-textfield pmd-textfield-floating-label">
								<label for="agama" class="control-label">Berat Badan</label>
								<input type="number" name="bb" value="<?= $data['bb'] ?>" class="form-control" id="agama">
								<p class="help-block">*) Dalam Kilogram</p>
							</div>
						</div>
					</div>
				</div>

				<div class="pmd-card pmd-card-default pmd-z-depth">
					<div class="pmd-card-title" style="background-color: #4682B4; color: white">
						<h2 class="pmd-card-title-text" style="margin-bottom: 15px;">
							<i class="material-icons">directions_run</i> Kemampuan Peserta
						</h2>
					</div>
					<div class="pmd-card-body">
						<div class="form-group pmd-textfield pmd-textfield-floating-label">
							<label for="agama" class="control-label">Bakat</label>
							<textarea name="bakat" id="" cols="30" rows="10" class="form-control"><?= $data['bakat'] ?></textarea>
						</div>
						<div class="form-group pmd-textfield">
							<label for="agama" class="control-label">Bahasa yang dikuasai</label>
							<textarea name="bahasa" id="" placeholder="1. Bahasa Indonesia (Aktif) dst" cols="30" rows="10" class="form-control"><?= $data['bahasa'] ?></textarea>
						</div>
					</div>
				</div>

				<div style="margin-top: 20px;">
					<button class="btn btn-danger pmd-ripple-effect pmd-z-depth" style="width: 100%; background-color: #4682B4;">simpan</button>
				</div>
			</form>


		</div>
	</div>

</div>