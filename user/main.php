<?php

$sql = "SELECT * FROM peserta";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($query);

?>

<div id="content" class="pmd-content inner-page">

	<div class="container-fluid full-width-container blank">

		<h1 class="section-title">
			<span>Informasi</span>
		</h1>

		<ol class="breadcrumb text-left">
			<li><a href="" style="color: #4682B4">Beranda</a></li>
		</ol>

		<div class="no-table-blank-state">
        <?php 
            if ($data['status']==2) { ?>
                <div class="alert alert-success" role="alert">
                    Selamat Anda Dinyatakan Lulus Seleksi
                </div>
            <?php } else if($data['status']=1) { ?>
                <div class="alert alert-danger" role="alert">
                    Mohon maaf, Anda Tidak Dinyatakan Lulus Seleksi. Tetap Semangat!
                </div>
            <?php } else { ?>
                <div class="alert alert-info" role="alert">
                    Data Anda Sedang di Proses.
                </div>
            <?php } ?>
		</div>
	</div>

</div>