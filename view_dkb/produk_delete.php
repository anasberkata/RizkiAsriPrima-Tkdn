<?php
session_start();

if (!isset($_SESSION['login'])) {
	header("Location: ../index.php");
	exit;
}

require "../functions.php";

$id_produk = $_GET["id_produk"];

if (produk_delete($id_produk) > 0) {
	echo "
		<script>
			alert('Produk berhasil dihapus!');
			document.location.href = 'produk.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('Produk gagal dihapus!');
			document.location.href = produk.php';
		</script>

	";
}