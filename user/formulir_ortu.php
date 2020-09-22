<?php

$sql = "SELECT * FROM data_orangtua WHERE email = '" . $_SESSION['username'] . "'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($query);

?>

<div id="content" class="pmd-content inner-page">

	<div class="container-fluid full-width-container blank">

		<h1 class="section-title">
			<span>Formulir Data Orang Tua</span>
		</h1>

		<ol class="breadcrumb text-left">
			<li><a href="">Beranda</a></li>
			<li class="active">Formulir Data Orang Tua</li>
		</ol>

		<div class="no-table-blank-state">
			<?php
			if (isset($_SESSION['msg'])) {
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			} ?>
			<form action="./process/input_ortu.php" method="POST">
				<div class="pmd-card pmd-z-depth pmd-card-default" style="margin-bottom: 20px;">
					<div class="pmd-card-title" style="background-color: #4682B4; color: white;">
						<h2 class="pmd-card-title-text" style="margin-bottom: 15px;">
							<i class="material-icons">content_paste</i> Data Orang Tua
						</h2>
					</div>
					<div class="pmd-card-body">

						<div class="group-fields clearfix row">
							<div class="form-group col-lg-12 pmd-textfield pmd-textfield-floating-label">
								<label for="namal" class="control-label">Nama Ayah</label>
								<input type="text" name="nama_ayah" value="<?= $data['nama_ayah'] ?>" class="form-control" id="namal">
							</div>

							<div class="form-group col-lg-6 col-md-12 col-sm-12 pmd-textfield pmd-textfield-floating-label">
								<label for="namap" class="control-label">Pekerjaan Ayah</label>
								<input type="text" name="pekerjaan_ayah" value="<?= $data['pekerjaan_ayah'] ?>" class="form-control" id="namap">
							</div>

							<div class="form-group col-lg-6 col-md-12 col-sm-12 pmd-textfield pmd-textfield-floating-label">
								<label for="tgl" class="control-label">Nomor HP Ayah</label>
								<input type="text" name="hp_ayah" value="<?= $data['hp_ayah'] ?>" class="form-control" id="tgl">
							</div>

							<div class="form-group col-lg-12 pmd-textfield pmd-textfield-floating-label">
								<label for="namal" class="control-label">Nama Ibu</label>
								<input type="text" name="nama_ibu" value="<?= $data['nama_ibu'] ?>" class="form-control" id="namal">
							</div>

							<div class="form-group col-lg-6 col-md-12 col-sm-12 pmd-textfield pmd-textfield-floating-label">
								<label for="namap" class="control-label">Pekerjaan Ibu</label>
								<input type="text" name="pekerjaan_ibu" value="<?= $data['pekerjaan_ibu'] ?>" class="form-control" id="namap">
							</div>

							<div class="form-group col-lg-6 col-md-12 col-sm-12 pmd-textfield pmd-textfield-floating-label">
								<label for="tgl" class="control-label">Nomor HP Ibu</label>
								<input type="text" name="hp_ibu" value="<?= $data['hp_ibu'] ?>" class="form-control" id="tgl">
							</div>
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