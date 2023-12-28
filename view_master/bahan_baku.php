<?php
session_start();

include "../templates/header.php";

$bahan_baku = query(
    "SELECT * FROM bahan_baku
    INNER JOIN produsen
    ON bahan_baku.produsen_id = produsen.id_produsen
    ");
?>


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title">Data Bahan Baku</h4>
                    <p class="text-muted">
                        <a href="bahan_baku_add.php" class="btn btn-primary text-white">
                            <i class="mdi mdi-plus"></i> Tambah Bahan Baku
                        </a>
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-white" id="datatable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Nama Bahan Baku </th>
                                <th> Satuan </th>
                                <th> Spesifikasi </th>
                                <th> Foto </th>
                                <th> Produsen </th>
                                <th> Harga Satuan </th>
                                <th> Opsi </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($bahan_baku as $bb): ?>
                                <tr>
                                    <td>
                                        <?= $i; ?>
                                    </td>
                                    <td>
                                        <?= $bb["nama_bahan_baku"]; ?>
                                    </td>
                                    <td>
                                        <?= $bb["satuan"]; ?>
                                    </td>
                                    <td>
                                        <?= $bb["spesifikasi"]; ?>
                                    </td>
                                    <td>
                                        <img src="../assets/images/bahan_baku/<?= $bb["foto"]; ?>">

                                    </td>
                                    <td>
                                        <?= $bb["nama_produsen"]; ?>
                                    </td>
                                    <td>
                                        Rp.
                                        <?= number_format($bb["harga_satuan"], 0, ',', '.'); ?>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="bahan_baku_edit.php?id_bahan_baku=<?= $bb["id_bahan_baku"] ?>"
                                                class="btn btn-info text-white mt-1"><i
                                                    class="mdi mdi-circle-edit-outline"></i></a>
                                            <a href="bahan_baku_delete.php?id_bahan_baku=<?= $bb["id_bahan_baku"] ?>"
                                                class="btn btn-danger text-white mt-1"
                                                onclick="return confirm('Yakin ingin menghapus <?= $bb['nama_bahan_baku']; ?>?');"><i
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