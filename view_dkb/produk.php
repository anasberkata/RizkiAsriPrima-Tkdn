<?php
session_start();

include "../templates/header.php";

$produk = query(
    "SELECT * FROM produk
    INNER JOIN users ON produk.penanggung_jawab = users.id_user
    ORDER BY tanggal DESC
    ");
?>


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title">Data Daftar Kebutuhan Bahan</h4>
                    <p class="text-muted">
                        <a href="produk_add.php" class="btn btn-primary text-white">
                            <i class="mdi mdi-plus"></i> Tambah Produk
                        </a>
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-white" id="datatable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Nama Produk </th>
                                <th> Penanggung Jawab </th>
                                <th> Tanggal </th>
                                <th> Opsi </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($produk as $p): ?>
                                <tr>
                                    <td>
                                        <?= $i; ?>
                                    </td>
                                    <td>
                                        <?= $p["nama_produk"]; ?>
                                    </td>
                                    <td>
                                        <?= $p["nama"]; ?>
                                    </td>
                                    <td>
                                        <?= $p["tanggal"]; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="dkb.php?id_produk=<?= $p["id_produk"] ?>"
                                                class="btn btn-success text-white mt-1"><i
                                                    class="mdi mdi-view-list"></i></a>
                                            <a href="produk_edit.php?id_produk=<?= $p["id_produk"] ?>"
                                                class="btn btn-info text-white mt-1"><i
                                                    class="mdi mdi-circle-edit-outline"></i></a>
                                            <a href="produk_delete.php?id_produk=<?= $p["id_produk"] ?>"
                                                class="btn btn-danger text-white mt-1"
                                                onclick="return confirm('Yakin ingin menghapus <?= $p['nama_produk']; ?>?');"><i
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