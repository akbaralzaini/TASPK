<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['id_role'])) {
	switch($_SESSION['id_role']) {
		case 1:
			header('location:admin');
			break;

		case 2:
			header('location:penilai');
			break;

		case 3:
			header('location:user');
			break;
	}

	exit;
}


?>