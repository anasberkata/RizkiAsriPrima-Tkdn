<?php
session_start();

include "../templates/header.php";

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

?>


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex row mb-3">
                    <div class="col-12 col-md-8">
                        <h4 class="card-title">Input Daftar Kebutuhan Bahan : <br>
                            Produk :
                            <?= $p["nama_produk"]; ?> |
                            Tanggal :
                            <?= $p["tanggal"]; ?> |
                            Penanggung Jawab :
                            <?= $p["nama"]; ?>
                        </h4>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="btn-group w-100">
                            <a href="dkb_add.php?id_produk=<?= $id_produk; ?>" class="btn btn-primary text-white">
                                <i class="mdi mdi-plus"></i> Tambah
                            </a>
                            <a href="dkb_print.php?id_produk=<?= $id_produk; ?>" class="btn btn-warning text-white"
                                target="_blank">
                                <i class="mdi mdi-printer"></i> Print
                            </a>
                            <a href="dkb_download.php?id_produk=<?= $id_produk; ?>" class="btn btn-success text-white"
                                target="_blank">
                                <i class="mdi mdi-download"></i> Download
                            </a>
                        </div>
                    </div>


                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-white">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center"> # </th>
                                <th rowspan="2" class="text-center"> Nama <br> Bahan Baku </th>
                                <th rowspan="2" class="text-center"> Spesifikasi </th>
                                <th rowspan="2" class="text-center"> Satuan <br> Bahan <br> Baku </th>
                                <th rowspan="2" class="text-center"> Negara Asal </th>
                                <th rowspan="2" class="text-center"> Pemasok / <br> Produsen </th>
                                <th rowspan="2" class="text-center"> TKDN <br> (%) </th>
                                <th rowspan="2" class="text-center"> Jumlah <br> Pemakaian <br> untuk 1 (Satu) <br>
                                    Satuan Produk </th>
                                <th rowspan="2" class="text-center"> Harga Satu <br> Satuan Meterial <br> (Rp) </th>
                                <th colspan="3" class="text-center"> Biaya (Rupiah) </th>
                                <th rowspan="2" class="text-center"> Opsi </th>
                            </tr>
                            <tr>
                                <th> KDN </th>
                                <th> KLN </th>
                                <th> Total </th>
                            </tr>
                            <tr>
                                <th class="text-center">(1)</th>
                                <th class="text-center">(2)</th>
                                <th class="text-center">(3)</th>
                                <th class="text-center">(4)</th>
                                <th class="text-center">(5)</th>
                                <th class="text-center">(6)</th>
                                <th class="text-center">(7)</th>
                                <th class="text-center">(8)</th>
                                <th class="text-center">(9)</th>
                                <th class="text-center" colspan="3">(10)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($dkb as $d): ?>
                                <tr>
                                    <td>
                                        <?= $i; ?>
                                    </td>
                                    <td>
                                        <?= $d["nama_bahan_baku"]; ?>
                                    </td>
                                    <td>
                                        <?= $d["spesifikasi"]; ?>
                                    </td>
                                    <td>
                                        <?= $d["satuan"]; ?>
                                    </td>
                                    <td>
                                        <?= $d["negara"]; ?>
                                    </td>
                                    <td>
                                        <?= $d["nama_produsen"]; ?>
                                    </td>
                                    <td>
                                        <?= $d["tkdn"]; ?>%
                                    </td>
                                    <td>
                                        <?= $d["qty_pemakaian"]; ?>
                                    </td>
                                    <td>
                                        Rp.
                                        <?= number_format($d["harga_satuan"], 0, ',', '.'); ?>
                                    </td>
                                    <td>
                                        Rp.
                                        <?= $d["kdn"]; ?>
                                    </td>
                                    <td>
                                        Rp.
                                        <?= $d["kln"]; ?>
                                    </td>
                                    <td>
                                        Rp.
                                        <?= $d["total"]; ?>
                                    </td>
                                    <td>
                                        <div class=" btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="dkb_edit.php?id_dkb=<?= $d["id_dkb"] ?>&id_produk=<?= $id_produk; ?>"
                                                class="btn btn-info text-white mt-1"><i
                                                    class="mdi mdi-circle-edit-outline"></i></a>
                                            <a href="dkb_delete.php?id_dkb=<?= $d["id_dkb"] ?>&id_produk=<?= $id_produk; ?>"
                                                class="btn btn-danger text-white mt-1"
                                                onclick="return confirm('Yakin ingin menghapus <?= $d['nama_bahan_baku']; ?>?');"><i
                                                    class="mdi mdi-delete"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>

                            <tr>
                                <td colspan="9" class="text-right">Total</td>
                                <td>
                                    Rp.
                                    <?= $kdn_amount["amount_kdn"]; ?>
                                </td>
                                <td>
                                    Rp.
                                    <?= $kln_amount["amount_kln"]; ?>
                                </td>
                                <td>
                                    Rp.
                                    <?= $total_amount["amount_total"]; ?>
                                </td>
                                <td></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include "../templates/footer.php";
?>