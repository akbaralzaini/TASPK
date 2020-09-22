<div id="content" class="pmd-content inner-page">

	<div class="container-fluid full-width-container blank">

		<h1 class="section-title">
			<span>Beranda</span>
		</h1>

		<ol class="breadcrumb text-left">
			<li class="active">Beranda</li>
		</ol>

		<div class="no-table-blank-state">
			<?php
			if (isset($_SESSION['msg'])) {
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			} ?>
			<div class="pmd-card pmd-card-custom-view pmd-z-depth">
				<div class="pmd-card-title">
					<!-- <button style="float: right; display: inline;" class="btn btn-primary btn-sm pmd-z-depth pmd-ripple-effect">
						<i class="material-icons">add</i>
					</button> -->
				<div class="table-responsive">
					<form action="./process/input_nilai.php" method="POST">
					<h2 class="pmd-card-title-text">
						 Penilaian <?=       
						$_SESSION['penilai']['nama'] ?>   
					</h2>
				</div>
						<table class="table pmd-table table-striped">
							<thead>
								<tr>
									<th style="width: 20%">Peserta</th>
									<th>
										<select style="width: 100%" name="peserta" id="">
											<?php
											include '../config/koneksi.php';

											$peserta = mysqli_query($koneksi, "SELECT * FROM `peserta` WHERE `peserta`.`status` = '2' AND `peserta`.`email` NOT IN (SELECT `email` FROM `nilai` WHERE `id_kriteria` = '".$_SESSION['penilai']['id_kriteria']."')");
											while ($rows = mysqli_fetch_array($peserta)) {
											?>
												<option value="<?= $rows['email'] ?>"><?= $rows['id_peserta'] . " | " . $rows['nama'] ?></option>
											<?php } ?>
										</select>
									</th>
									<th>
										<button type="submit" class="btn btn-sm btn-primary pmd-ripple-effect">SELESAI</button>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php

								$query = mysqli_query($koneksi, "SELECT * FROM `sub_kriteria` WHERE `id_kriteria` = '" . $_SESSION['penilai']['id_kriteria'] . "'");
								while ($row = mysqli_fetch_array($query)) {
								?>
									<tr>
										<td><?= $row['nama'] ?></td>
										<td colspan="2">
											<?php
											$sql = "SELECT * FROM `pertanyaan` WHERE `id_kriteria` = '" . $row['id'] . "'";
											$querys = mysqli_query($koneksi, $sql);
											$penilaian = mysqli_fetch_assoc($querys);

											if ($penilaian['tipe'] == 2) {
												$data = explode('`', base64_decode($penilaian['soal']));
												$val = explode(';', $data[1]);
												$opt = explode('|', $data[0]);
												for ($i = 0; $i < count($val); $i++) { ?>
													<div class="form-group">
														<div class="checkbox pmd-default-theme">
															<label class="pmd-checkbox pmd-checkbox-ripple-effect">
																<input type="checkbox" name="<?= $row['nama'] ?>[]" value="<?= $val[$i] ?>">
																<span><?= $opt[$i] ?></span>
															</label>
														</div>
													</div>

												<?php } ?>


											<?php } else { ?>

												<input type="number" name="<?= $row['nama'] ?>" class="form-control">

											<?php } ?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>