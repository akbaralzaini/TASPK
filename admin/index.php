<?php

include './template/title.php';
include './template/navbar.php';
include './template/sidebar.php';

if(isset($_GET['c'])) {
	include './'.base64_decode($_GET['c']).'.php';
} else {
	include './main.php';
}

include './template/footer.php';
