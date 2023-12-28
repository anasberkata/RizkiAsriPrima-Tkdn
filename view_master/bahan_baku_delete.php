<?php
session_start();

if (!isset($_SESSION['login'])) {
	header("Location: ../index.php");
	exit;
}

require "../functions.php";

$id_bahan_baku = $_GET["id_bahan_baku"];

if (bahan_baku_delete($id_bahan_baku) > 0) {
	echo "
		<script>
			alert('Bahan baku berhasil dihapus!');
			document.location.href = 'bahan_baku.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('Bahan baku gagal dihapus!');
			document.location.href = bahan_baku.php';
		</script>
	";
}