<div id="content" class="pmd-content inner-page">

	<style>
		td {
			vertical-align: middle !important;
		}
	</style>

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
                    <h2 style="display: inline" class="pmd-card-title-text">
                        Daftar Penilai
                    </h2>
                    <a style="float: right; margin-top: -7px;" data-target="#small-dialog" data-toggle="modal" class="btn btn-primary btn-sm pmd-z-depth pmd-btn-flat pmd-btn-fab pmd-ripple-effect">
                        <i class="material-icons">add</i>
                    </a>
                    <div tabindex="-1" class="modal fade in" id="small-dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm" style="z-index: 999999999999">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                    <div class="media-body media-middle">
                                        <h3 class="pmd-card-title-text">Tambah Penilai</h3>
                                    </div>
                                </div>
                                
                                <form action="./process/tambah_penilai.php" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group pmd-textfield">
                                            <label>Username</label>
                                            <input type="text" placeholder="Username" name="username" class="form-control">
                                        </div>
                                        <div class="form-group pmd-textfield">
                                            <label>Password</label>
                                            <input type="password" placeholder="Password" name="password" class="form-control">
                                        </div>
                                        <?php 

                                            include '../config/koneksi.php';
                                            $kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria");
                                        ?>
                                        <div class="form-group pmd-textfield">
                                            <label>Pilih Kriteria</label>
                                            <select name="kriteria" style="width: 100%" class="select-simple form-control pmd-select2">
                                                <?php while($row = mysqli_fetch_array($kriteria)) { ?>
                                                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="pmd-modal-action" style="text-align: right">
                                        <button data-dismiss="modal" type="submit" class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-danger"> <i class="material-icons pmd-sm">cancel</i> </button>
                                        <button type="submit" class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary"> <i class="material-icons pmd-sm">send</i> </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table pmd-table table-striped table-sm" cellspacing="0" cellpadding="0" id="table-bootstrap">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th>Username</th>
                                <th>Kriteria</th>
                                <th style="width:25%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT `user`.`username`, `penilai`.`id_kriteria`, `kriteria`.`nama` FROM `user` INNER JOIN `penilai` ON `user`.`username` = `penilai`.`username` INNER JOIN `kriteria` ON `penilai`.`id_kriteria` = `kriteria`.`id` WHERE `id_role` = '2'");
                            $no = 0;
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?= ++$no ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td>
                                        <a style="margin-right: 7px;" data-target="#small-dialog<?= $no ?>" data-toggle="modal" class="btn btn-sm btn-warning pmd-btn-fab pmd-btn-flat pmd-ripple-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <div tabindex="-1" class="modal fade in" id="small-dialog<?= $no ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" style="z-index: 999999999999">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                        <div class="media-body media-middle">
                                                            <h3 class="pmd-card-title-text">Ubah Password</h3>
                                                        </div>
                                                    </div>
                                                    
                                                    <form action="./process/ubah_password.php" method="POST">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="username" value="<?= $row['username'] ?>">
                                                            <div class="form-group pmd-textfield">
                                                                <label>Password Baru</label>
                                                                <input type="password" placeholder="Password" name="password" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="pmd-modal-action" style="text-align: right">
                                                            <button data-dismiss="modal" type="submit" class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-danger"> <i class="material-icons pmd-sm">cancel</i> </button>
                                                            <button type="submit" class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary"> <i class="material-icons pmd-sm">send</i> </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="./process/hapus_penilai.php?username=<?= $row['username'] ?>" class="btn btn-sm btn-danger pmd-btn-fab pmd-btn-flat pmd-ripple-effect">
                                            <i class="material-icons">delete</i>
                                        </a>
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