<?php

// require_once __DIR__ . '/vendor/autoload.php';
require_once '../vendor/autoload.php';
require '../functions.php';

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

$html .= '<h5>Formulir 1.1 : TKDN untuk Bahan Baku (Bahan baku langsung / tidak langsung)</h5>
<table cellpadding=5 cellspacing=0 style="font-family: serif; font-size: 10px; width: 100%; margin-bottom: 5px; border: 2px solid #000">
    <tr>
        <td width="20%">Penyedia Barang / Jasa</td>
        <td>: PT. Rizky Asri Prima</td>
    </tr>
    <tr>
        <td width="20%">Hasil Produksi</td>
        <td>: ' . $p["nama_produk"] . '</td>
    </tr>
    <tr>
        <td width="20%">Jenis Produk</td>
        <td>:</td>
    </tr>
    <tr>
        <td width="20%">Spesifikasi</td>
        <td>:</td>
    </tr>
    <tr>
        <td width="20%">Standar</td>
        <td>:</td>
    </tr>
</table>
';

$html .= '<table border=1 cellpadding=5 cellspacing=0 style="font-family: serif; font-size: 10px; width: 100%">
    <thead>
        <tr>
            <th rowspan="2"> # </th>
            <th rowspan="2"> Nama <br> Bahan Baku </th>
            <th rowspan="2"> Spesifikasi </th>
            <th rowspan="2"> Satuan <br> Bahan <br> Baku </th>
            <th rowspan="2"> Negara Asal </th>
            <th rowspan="2"> Pemasok / <br> Produsen </th>
            <th rowspan="2"> TKDN <br> (%) </th>
            <th rowspan="2"> Jumlah <br> Pemakaian <br> untuk 1 (Satu) <br>
                Satuan Produk </th>
            <th rowspan="2"> Harga Satu <br> Satuan Meterial <br> (Rp) </th>
            <th colspan="3"> Biaya (Rupiah) </th>
        </tr>
        <tr>
            <th> KDN </th>
            <th> KLN </th>
            <th> Total </th>
        </tr>
        <tr>
            <th class="text-center" style="font-size: 6px;">(1)</th>
            <th class="text-center" style="font-size: 6px;">(2)</th>
            <th class="text-center" style="font-size: 6px;">(3)</th>
            <th class="text-center" style="font-size: 6px;">(4)</th>
            <th class="text-center" style="font-size: 6px;">(5)</th>
            <th class="text-center" style="font-size: 6px;">(6)</th>
            <th class="text-center" style="font-size: 6px;">(7)</th>
            <th class="text-center" style="font-size: 6px;">(8)</th>
            <th class="text-center" style="font-size: 6px;">(9)</th>
            <th class="text-center" style="font-size: 6px;" colspan="3">(10)</th>
        </tr>
    </thead>
    <tbody>';

$i = 1;
foreach ($dkb as $d) {
    $html .= '<tr>
        <td>' . $i . '</td>
        <td>' . $d["nama_bahan_baku"] . '</td>
        <td>' . $d["spesifikasi"] . '</td>
        <td>' . $d["satuan"] . '</td>
        <td>' . $d["negara"] . '</td>
        <td>' . $d["nama_produsen"] . '</td>
        <td>' . $d["tkdn"] . '%</td>
        <td>' . $d["qty_pemakaian"] . '</td>
        <td>Rp. ' . number_format($d["harga_satuan"], 0, ',', '.') . '</td>
        <td>Rp. ' . $d["kdn"] . '</td>
        <td>Rp. ' . $d["kln"] . '</td>
        <td>Rp. ' . $d["total"] . '</td>
    </tr>';
    $i++;
}

$html .= '<tr>
    <td colspan="9" style="text-align: right;">Total</td>
    <td>Rp. ' . $kdn_amount["amount_kdn"] . '</td>
    <td>Rp. ' . $kln_amount["amount_kln"] . '</td>
    <td>Rp. ' . $total_amount["amount_total"] . '</td>
</tr>';

$html .= '</tbody></table>
<p style="font-family: serif; font-size: 10px;">Catatan : <br>
    <ol style="font-family: serif; font-size: 10px;">
        <li>Pada Form ini diisikan nama-nama material yang digunakan sebagai bahan baku untuk membuat produk</li>
        <li>Satuan Mata Uang yang digunakan dalam perhitungan TKDN disesuaikan dengan Satuan Mata Uang yang digunakan oleh Perusahaan</li>
    </ol>
</p>
';


$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);

// $stylesheet = file_get_contents('style_print.css');
// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML("$html", \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('dkb ' . $p["nama_produk"] . " " . $p["tanggal"] . '.pdf', 'I');