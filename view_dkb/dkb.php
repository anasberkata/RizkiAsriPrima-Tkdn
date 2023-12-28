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
?>


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title">Input Daftar Kebutuhan Bahan : <br>
                        Produk :
                        <?= $p["nama_produk"]; ?> |
                        Tanggal :
                        <?= $p["tanggal"]; ?> |
                        Penanggung Jawab :
                        <?= $p["nama"]; ?>
                    </h4>
                    <p class="text-muted">
                        <a href="dkb_add.php?id_produk=<?= $id_produk; ?>" class="btn btn-primary text-white">
                            <i class="mdi mdi-plus"></i> Tambah Bahan Baku
                        </a>
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-white" id="datatable">
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
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
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