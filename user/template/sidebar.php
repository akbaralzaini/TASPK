<div class="pmd-sidebar-overlay"></div>

<aside id="basicSidebar" class="pmd-sidebar sidebar-default pmd-sidebar-slide-push pmd-sidebar-left pmd-sidebar-open sidebar-with-icons" role="navigation" style="background-color: #0b031b">
	<ul class="nav pmd-sidebar-nav">

		<li class="dropdown pmd-dropdown pmd-user-info visible-xs visible-md visible-sm visible-lg">
			<a aria-expanded="false" data-toggle="dropdown" class="btn-user dropdown-toggle media" data-sidebar="true" aria-expandedhref="javascript:void(0);" style="border: none">
				<div class="media-left">
					<?php

					$foto = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT `foto` FROM `peserta` WHERE `email` = '" . $_SESSION['username'] . "'"));

					if ($foto['foto'] == null) {  ?>
						<img src="../assets/themes/images/user-icon.png" alt="New User">
					<?php } else { ?>
						<img src="./process/foto_peserta/<?= $foto['foto'] ?>" height="40" style="border-radius: 50%" alt="New User">
					<?php } ?>
				</div>
				<div class="media-body media-middle"><?= $_SESSION['username'] ?></div>
				<div class="media-right media-middle"><i class="dic-more-vert dic"></i></div>
			</a>
			<ul class="dropdown-menu">
				<li><a href="../logout.php">Logout</a></li>
			</ul>
		</li>

		<li>
			<a class="pmd-ripple-effect <?php if (empty($_GET['act'])) {
											echo "active";
										} ?>" href="./index.php">
				<i class="media-left media-middle material-icons">home</i>
				<span class="media-body">Beranda</span>
			</a>
		</li>
		
		<?php 
		//membuat menu hilang ketika waktu sudah penutupan pendaftaran
		date_default_timezone_set("Asia/Jakarta");
		$date = date("Y-m-d");
		$date=date('Y-m-d', strtotime($date));
		$contractDateBegin = date('Y-m-d', strtotime("01/01/2021"));
		if ($date >= $contractDateBegin) { ?>

			<li class="dropdown pmd-dropdown pmd-sidebar-dropdown <?php if (isset($_GET['act']) && base64_decode($_GET['act']) == 1) {
																		echo "open";
																	} ?>">
				<a aria-expanded="false" data-toggle="dropdown" class="btn-user dropdown-toggle media pmd-ripple-effect <?php if (isset($_GET['act']) && base64_decode($_GET['act']) == 1) {
																															echo "active";
																														} ?>" data-sidebar="true" aria-expandedhref="javascript:void(0);">
					<i class="media-left media-middle material-icons">content_paste</i>
					<span class="media-body">Formulir Pendaftaran</span>
				</a>
				<ul class="dropdown-menu" <?php if (empty($_GET['act']) or base64_decode($_GET['act']) != 1) {
												echo 'style="background-color: #0b031b;"';
											} ?>>
					<li><a href="./index.php?c=<?= base64_encode('formulir') ?>&act=<?= base64_encode('1') ?>">Data Diri</a></li>
					<li><a href="./index.php?c=<?= base64_encode('formulir_ortu') ?>&act=<?= base64_encode('1') ?>">Data Orang Tua</a></li>
					<li><a href="./index.php?c=<?= base64_encode('formulir_pend_pres') ?>&act=<?= base64_encode('1') ?>">Data Pendidikan &amp; Prestasi</a></li>
				</ul>
			</li>

			<li>
				<a class="pmd-ripple-effect <?php if (isset($_GET['act']) && base64_decode($_GET['act']) == 2) {
												echo "active";
											} ?>" href="./index.php?c=<?= base64_encode('unggah') ?>&act=<?= base64_encode('2') ?>">
					<i class="media-left media-middle material-icons">cloud_upload</i>
					<span class="media-body">Unggah Berkas</span>
				</a>
			</li>

		<?php } ?>

		
		</li>

	</ul>
</aside>