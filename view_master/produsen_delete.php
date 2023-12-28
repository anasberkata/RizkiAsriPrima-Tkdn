<?php
session_start();

if (!isset($_SESSION['login'])) {
	header("Location: ../index.php");
	exit;
}

require "../functions.php";

$id_produsen = $_GET["id_produsen"];

if (produsen_delete($id_produsen) > 0) {
	echo "
		<script>
			alert('Produsen berhasil dihapus!');
			document.location.href = 'produsen.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('Produsen gagal dihapus!');
			document.location.href = produsen.php';
		</script>

	";
}