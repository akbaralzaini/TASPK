<?php

include '../config/koneksi.php';

$sql = "SELECT * FROM `kriteria`";
$query = mysqli_query($koneksi, $sql);

?>

<div id="content" class="pmd-content pmd-content-custom">

	<div class="container-fluid full-width-container blank">

		<h1 class="section-title">
			<span>Daftar Kriteria</span>
		</h1>

		<ol class="breadcrumb text-left">
			<li><a href="./index.php">Beranda</a></li>
			<li class="active">Daftar Kriteria</li>
		</ol>

		<section class="no-table-blank-state">
			<?php if (isset($_SESSION['msg'])) {
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			} ?>
			<div class="row">
				<div class="col-md-8" style="margin-bottom:20px">
					<div class="table-responsive pmd-card pmd-z-depth">
						<table class="table table-mc-red pmd-table">
							<thead>
								<tr>
									<th>Keterangan</th>
									<th>Bobot</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php $num_penilaian = 0;
								while ($row = mysqli_fetch_array($query)) { ?>
									<tr>
										<td><?= $row['nama'] ?></td>
										<td><?= $row['bobot'] ?></td>
										<td class="pmd-table-row-action">
											<button data-target="#form-dialog<?= ++$num_penilaian ?>" data-toggle="modal" type="button" class="btn pmd-btn-fab pmd-btn-flat p<md-ripple-effect btn-default btn-sm">
												<i class="material-icons md-dark pmd-sm">edit</i>
											</button>
											<div tabindex="-1" class="modal fade" id="form-dialog<?= $num_penilaian ?>" style="display: none;" aria-hidden="true">
												<div class="modal-dialog">
													<form class="form-horizontal" method="POST" action="./process/edit_kriteria.php">
														<div class="modal-content">
															<div class="modal-header bordered">
																<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
																<h2 class="pmd-card-title-text">Form Modal</h2>
															</div>
															<div class="modal-body">
																<input type="hidden" name="id" value="<?= $row['id'] ?>">
																<div class="form-group pmd-textfield pmd-textfield-floating-label">
																	<label for="first-name">Nama Kriteria</label>
																	<input type="text" class="mat-input form-control" id="name" name="nama" value="<?= $row['nama'] ?>">
																</div>
																<div class="form-group pmd-textfield pmd-textfield-floating-label">
																	<label for="first-name">Bobot</label>
																	<input type="number" class="mat-input form-control" id="email" name="bobot" value="<?= $row['bobot'] ?>">
																</div>
															</div>
															<div class="pmd-modal-action">
																<button class="btn pmd-ripple-effect btn-primary" type="submit">Save changes</button>
																<button data-dismiss="modal" class="btn pmd-ripple-effect btn-default" type="button">Discard</button>
															</div>
														</div>
												</div>
												</form>
											</div>
					</div>

					<a href="./process/hapus_kriteria.php?id=<?= base64_encode($row['id']) ?>" class="btn pmd-btn-fab pmd-btn-flat btn-default btn-sm">
						<i class="material-icons md-dark pmd-sm">delete</i>
					</a>
					<a href="javascript:void(0);" class="btn pmd-btn-fab pmd-btn-flat btn-default btn-sm child-table-expand direct-expand"><i class="material-icons md-dark pmd-sm"></i></a>
					</td>
					</tr>
					<tr class="child-table">
						<td colspan="12">
							<div class="direct-child-table" style="display:none">
								<form action="./process/sub_krit.php?id=<?= $row['id'] ?>" method="POST">
									<table class="table pmd-table table-striped table-sm">
										<thead>
											<tr>
												<th>
													Tambah Sub Kriteria
												</th>
												<th>
													<input type="text" placeholder="Nama Sub" name="nama" class="form-control" required>
												</th>
												<th style="width:15%">
													<button type="submit" class="btn btn-primary pmd-btn-fab pmd-btn-flat btn-sm">
														<i class="material-icons">send</i>
													</button>
												</th>
											</tr>
											<tr id="penilaian<?= $num_penilaian ?>">
												<th>
													Tipe Penilaian
												</th>
												<th>
													<select name="tipe_nilai" class="tipe" id="<?= $num_penilaian ?>" style="width: 100%">
														<option>Pilih Tipe Penilaian</option>
														<option value="1">Nilai Angka</option>
														<option value="2">Checklist</option>
													</select>
												</th>
												<th id="koloms<?= $num_penilaian ?>">

												</th>
											</tr>
										</thead>
									</table>
								</form>
								<table class="table pmd-table table-striped table-sm">
									<thead>
										<tr>
											<th style="width: 15%">No</th>
											<th>Sub Kriteria</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php

										$query1 = mysqli_query($koneksi, "SELECT * FROM `sub_kriteria` WHERE `id_kriteria` = '" . $row['id'] . "'");
										$no = 0;
										while ($raws = mysqli_fetch_array($query1)) {

										?>
											<tr>
												<td><?= ++$no ?> </td>
												<td><?= $raws['nama'] ?></td>
												<td class="pmd-table-row-action">
													<a href="./process/hapus_sub.php?id=<?= $raws['id'] ?>" class="btn pmd-btn-fab pmd-btn-flat btn-default btn-xs"><i class="material-icons md-dark pmd-xs">delete</i></a>
												</td>
											</tr>

										<?php } ?>


									</tbody>
								</table>
							</div>
						</td>
					</tr>
				<?php } ?>
				</tbody>
				</table>
				</div>
			</div>

			<div class="col-md-4">
				<div class="pmd-card pmd-card-default pmd-z-depth">
					<div class="pmd-card-header">
						<h3 class="pmd-card-title">
							Tambah Kriteria
						</h3>
					</div>
					<div class="pmd-card-body">
						<form action="./process/add_kriteria.php" method="POST">
							<div class="form-group pmd-textfield">
								<label for="">Nama Kriteria</label>
								<input type="text" name="nama" class="form-control">
							</div>

							<div class="form-group pmd-textfield">
								<label for="">Bobot Kriteria</label>
								<input type="number" name="bobot" class="form-control">
							</div>

							<div style="text-align: center">
								<input type="submit" name="tambah" class="btn btn-primary w-100" value="Tambah Kriteria">
							</div>

						</form>
					</div>
				</div>
			</div>
	</div>
	</section>
</div>

</div>