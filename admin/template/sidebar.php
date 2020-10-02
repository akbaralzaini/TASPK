<div class="pmd-sidebar-overlay"></div>

<aside id="basicSidebar" class="pmd-sidebar sidebar-default pmd-sidebar-slide-push pmd-sidebar-left pmd-sidebar-open sidebar-with-icons" role="navigation" style="background-color: #0b031b">
	<ul class="nav pmd-sidebar-nav">

		<li class="dropdown pmd-dropdown pmd-user-info visible-xs visible-md visible-sm visible-lg">
			<a aria-expanded="false" data-toggle="dropdown" class="btn-user dropdown-toggle media" data-sidebar="true" aria-expandedhref="javascript:void(0);" style="border: none">
				<div class="media-left">
					<img src="../assets/themes/images/user-icon.png" alt="New User">
				</div>
				<div class="media-body media-middle"><?= $_SESSION['username'] ?></div>
				<div class="media-right media-middle"><i class="dic-more-vert dic"></i></div>
			</a>
			<ul class="dropdown-menu">
				<li><a href="../logout.php">Logout</a></li>
			</ul>
		</li>

		<li>
			<a class="<?php if (empty($_GET['act'])) {
							echo "active";
						} ?>" href="./index.php">
				<i class="media-left media-middle material-icons">home</i>
				<span class="media-body">Beranda</span>
			</a>
		</li>

		<li>
			<a class="<?php if (isset($_GET['act']) && base64_decode($_GET['act']) == 5) {
							echo "active";
						} ?>" href="./index.php?c=<?= base64_encode('daftar_penilai') ?>&act=<?= base64_encode('5') ?>">
				<i class="media-left media-middle material-icons">assignment</i>
				<span class="media-body">Daftar Juri</span>
			</a>
		</li>


		<li>
			<a class="<?php if (isset($_GET['act']) && base64_decode($_GET['act']) == 1) {
							echo "active";
						} ?>" href="./index.php?c=<?= base64_encode('daftar_peserta') ?>&act=<?= base64_encode('1') ?>">
				<i class="media-left media-middle material-icons">people</i>
				<span class="media-body">Peserta</span>
			</a>
		</li>

		<?php
		if (empty($_GET['c'])) {
			include '../config/koneksi.php';
		}

		$count = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM `aggregate_dominan`"));
		if ($count > 0) { ?>

			<li>
				<a class="<?php if (isset($_GET['act']) && base64_decode($_GET['act']) == 4) {
								echo "active";
							} ?>" href="./index.php?c=<?= base64_encode('daftar_nilai') ?>&act=<?= base64_encode('4') ?>">
					<i class="media-left media-middle material-icons">people</i>
					<span class="media-body">Peringkat Peserta</span>
				</a>
			</li>

		<?php } ?>

		<li>
			<a class="<?php if (isset($_GET['act']) && base64_decode($_GET['act']) == 2) {
							echo "active";
						} ?>" href="./index.php?c=<?= base64_encode('daftar_kriteria') ?>&act=<?= base64_encode('2') ?>">
				<i class="media-left media-middle material-icons">content_paste</i>
				<span class="media-body">Kriteria</span>
			</a>
		</li>

	</ul>
</aside>