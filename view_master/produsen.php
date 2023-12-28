<?php
session_start();

include "../templates/header.php";

$produsen = query(
    "SELECT * FROM produsen
    ");
?>


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title">Data Produsen</h4>
                    <p class="text-muted">
                        <a href="produsen_add.php" class="btn btn-primary text-white">
                            <i class="mdi mdi-account-plus"></i> Tambah Produsen
                        </a>
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-white" id="datatable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Nama Produsen </th>
                                <th> Phone </th>
                                <th> Alamat </th>
                                <th> Negara </th>
                                <th> Opsi </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($produsen as $p): ?>
                                <tr>
                                    <td>
                                        <?= $i; ?>
                                    </td>
                                    <td>
                                        <?= $p["nama_produsen"]; ?>
                                    </td>
                                    <td>
                                        <?= $p["phone"]; ?>
                                    </td>
                                    <td>
                                        <?= $p["alamat"]; ?>
                                    </td>
                                    <td>
                                        <?= $p["negara"]; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="produsen_edit.php?id_produsen=<?= $p["id_produsen"] ?>"
                                                class="btn btn-info text-white mt-1"><i
                                                    class="mdi mdi-account-edit"></i></a>
                                            <a href="produsen_delete.php?id_produsen=<?= $p["id_produsen"] ?>"
                                                class="btn btn-danger text-white mt-1"
                                                onclick="return confirm('Yakin ingin menghapus <?= $p['nama_produsen']; ?>?');"><i
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