<?php
require '../vendor/autoload.php';
require '../functions.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

// Ambil data dari database atau sumber lainnya
$id_produk = $_GET["id_produk"];

$p = query(
    "SELECT * FROM produk
    INNER JOIN users ON produk.penanggung_jawab = users.id_user
    WHERE id_produk = $id_produk"
)[0];

$dkb = query(
    "SELECT * FROM dkb
    INNER JOIN bahan_baku ON dkb.bahan_baku_id = bahan_baku.id_bahan_baku
    INNER JOIN produsen ON bahan_baku.produsen_id = produsen.id_produsen
    WHERE produk_id = $id_produk
    ");

$kdn_amount = query(
    "SELECT SUM(kdn) AS amount_kdn FROM dkb WHERE produk_id = $id_produk"
)[0];
$kln_amount = query(
    "SELECT SUM(kln) AS amount_kln FROM dkb WHERE produk_id = $id_produk"
)[0];
$total_amount = query(
    "SELECT SUM(total) AS amount_total FROM dkb WHERE produk_id = $id_produk"
)[0];

$data = array(
    array('#', 'Nama Bahan Baku', 'Spesifikasi', 'Satuan Bahan Baku', 'Negara Asal', 'Pemasok / Produsen', 'TKDN (%)', 'Jumlah Pemakaian untuk 1 Satuan Produk', 'Harga Satu Satuan Material (Rp)', 'KDN', 'KLN', 'Total'),
);

$i = 1;
foreach ($dkb as $d) {
    $data[] = array(
        $i,
        $d["nama_bahan_baku"],
        $d["spesifikasi"],
        $d["satuan"],
        $d["negara"],
        $d["nama_produsen"],
        $d["tkdn"] . '%',
        $d["qty_pemakaian"],
        'Rp. ' . number_format($d["harga_satuan"], 0, ',', '.'),
        'Rp. ' . $d["kdn"],
        'Rp. ' . $d["kln"],
        'Rp. ' . $d["total"],
    );
    $i++;
}

// Isi data ke lembar kerja Excel
$spreadsheet->getActiveSheet()->fromArray($data, null, 'A1');

// Merging Cells untuk Judul Total
$spreadsheet->getActiveSheet()->mergeCells('A' . ($i + 1) . ':I' . ($i + 1));
$spreadsheet->getActiveSheet()->setCellValue('A' . ($i + 1), 'Total');
$spreadsheet->getActiveSheet()->getStyle('A' . ($i + 1))->getAlignment()->setHorizontal('right');

$spreadsheet->getActiveSheet()->setCellValue('J' . ($i + 1), 'Rp. ' . $kdn_amount["amount_kdn"]);
$spreadsheet->getActiveSheet()->getStyle('J' . ($i + 1))->getAlignment()->setHorizontal('center');

$spreadsheet->getActiveSheet()->setCellValue('K' . ($i + 1), 'Rp. ' . $kln_amount["amount_kln"]);
$spreadsheet->getActiveSheet()->getStyle('K' . ($i + 1))->getAlignment()->setHorizontal('center');

$spreadsheet->getActiveSheet()->setCellValue('L' . ($i + 1), 'Rp. ' . $total_amount["amount_total"]);
$spreadsheet->getActiveSheet()->getStyle('L' . ($i + 1))->getAlignment()->setHorizontal('center');

// Menentukan path lengkap ke direktori tempat Anda ingin menyimpan file
$filePath = '../excel/dkb_' . $p["nama_produk"] . '_' . $p["tanggal"] . '.xlsx';

// Menyimpan file Excel
$writer = new Xlsx($spreadsheet);
$writer->save($filePath);

// echo '<script>window.history.go(-1);</script>';
// exit;

$excelFileUrl = '../excel/dkb_' . $p["nama_produk"] . '_' . $p["tanggal"] . '.xlsx';  // Sesuaikan dengan lokasi file Anda

// Tampilkan tautan unduh
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Excel</title>
</head>

<body>
    <h2>File Excel Telah Dibuat</h2>
    <p>Silakan unduh file Excel di bawah ini:</p>
    <a href="<?= $excelFileUrl ?>" download>Unduh File Excel</a>
</body>

</html>