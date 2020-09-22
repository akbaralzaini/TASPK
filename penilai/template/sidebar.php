
	<div class="pmd-sidebar-overlay"></div>

	<aside id="basicSidebar" class="pmd-sidebar sidebar-default pmd-sidebar-slide-push pmd-sidebar-left pmd-sidebar-open sidebar-with-icons" role="navigation">
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
				<a class="pmd-ripple-effect <?php if(empty($_GET['act'])) { echo "active"; } ?>" href="./index.php">	
					<i class="media-left media-middle material-icons">home</i>
					<span class="media-body">Beranda</span>
				</a> 
			</li>

			<li> 
				<a class="pmd-ripple-effect <?php if(isset($_GET['act']) && base64_decode($_GET['act']) == 1) { echo "active"; } ?>" href="./index.php?c=<?= base64_encode('daftar_peserta') ?>&act=<?= base64_encode('1') ?>">	
					<i class="media-left media-middle material-icons">people</i>
					<span class="media-body">Peserta</span>
				</a> 
			</li>
			
		</ul>
	</aside>
