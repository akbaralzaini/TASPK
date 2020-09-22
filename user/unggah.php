<div id="content" class="pmd-content inner-page">

	<div class="container-fluid full-width-container blank">

		<h1 class="section-title">
			<span>Unggah Berkas</span>
		</h1>

		<ol class="breadcrumb text-left">
			<li><a href="">Beranda</a></li>
			<li class="active">Unggah Berkas</li>
		</ol>

		<div class="no-table-blank-state">
			<?php if (isset($_SESSION['msg'])) {
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			} ?>

			<div class="row">
				<div class="col-md-8" style="margin-bottom: 10px;">
					<form action="./process/upload-berkas.php" method="POST" enctype="multipart/form-data">
						<div class="pmd-card pmd-card-default pmd-z-depth">
							<div class="pmd-card-body">
								<p>
									Berkas meliputi : <br>
									1. Surat Izin Orangtua <br>
									2. Surat Keterangan Aktif <br>
									3. Surat Perjanjian <br>
									4. Softcopy Sertifikat Terkait <br>
								</p>
								<hr>
								<div class="row">
									<div class="col-md-6" style="margin-bottom: 10px;">
										<input type="file" name="files">
									</div>

									<div class="col-md-6">
										<button type="submit" style="width: 100%; background-color: #4682B4;" class="btn btn-primary pmd-ripple-effect pmd-z-depth">upload</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>

				<div class="col-md-4">
					<div class="pmd-card pmd-card-default pmd-z-depth">
						<div class="pmd-card-header">
							<h3 class="pmd-card-title">Download Berkas</h3>
						</div>
						<div class="pmd-card-body">
							<a style="margin-bottom: 10px; width: 100%; background-color: #4682B4;" href="https://www.cekbaguscekayupalembang.com/registrasi/file/surat-izin-orang-tua" class="btn btn-primary pmd-ripple-effect pmd-z-depth">Surat Izin Orangtua</a>
							<a style="margin-bottom: 10px; width: 100%; background-color: #4682B4;" href="https://www.cekbaguscekayupalembang.com/registrasi/file/surat-keterangan-aktif" class="btn btn-primary pmd-ripple-effect pmd-z-depth">Surat Keterangan Aktif</a>
							<a style="margin-bottom: 10px; width: 100%; background-color: #4682B4;" href="https://www.cekbaguscekayupalembang.com/registrasi/file/surat-perjanjian" class="btn btn-primary pmd-ripple-effect pmd-z-depth">Surat Perjanjian</a>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>