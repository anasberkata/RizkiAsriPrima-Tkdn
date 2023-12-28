<?php
session_start();

if (!isset($_SESSION['login'])) {
	header("Location: ../index.php");
	exit;
}

require "../functions.php";

$id_dkb = $_GET["id_dkb"];
$id_produk = $_GET["id_produk"];

if (dkb_delete($id_dkb) > 0) {
	echo "
		<script>
			alert('Bahan baku berhasil dihapus!');
			document.location.href = 'dkb.php?id_produk=$id_produk';
		</script>
	";
} else {
	echo "
		<script>
			alert('Bahan baku gagal dihapus!');
			document.location.href = dkb.php?id_produk=$id_produk';
		</script>

	";
}