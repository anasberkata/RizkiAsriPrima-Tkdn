<?php
session_start();

include "../templates/header.php";

$users = query(
    "SELECT * FROM users
    INNER JOIN users_role ON users.role_id = users_role.id_role
    WHERE role_id = 2
    "
);
?>


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title">Data Pengguna</h4>
                    <p class="text-muted">
                        <a href="pengguna_add.php" class="btn btn-primary text-white">
                            <i class="mdi mdi-account-plus"></i> Tambah Pengguna
                        </a>
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-white" id="datatable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Nama </th>
                                <th> NIK </th>
                                <th> Email </th>
                                <th> Username </th>
                                <th> Role </th>
                                <th> Opsi </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td>
                                        <?= $i; ?>
                                    </td>
                                    <td>
                                        <?= $u["nama"]; ?>
                                    </td>
                                    <td>
                                        <?= $u["nik"]; ?>
                                    </td>
                                    <td>
                                        <?= $u["email"]; ?>
                                    </td>
                                    <td>
                                        <?= $u["username"]; ?>
                                    </td>
                                    <td>
                                        <?= $u["role"]; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="pengguna_edit.php?id_user=<?= $u["id_user"] ?>"
                                                class="btn btn-info text-white mt-1"><i
                                                    class="mdi mdi-account-edit"></i></a>
                                            <a href="pengguna_delete.php?id_user=<?= $u["id_user"] ?>"
                                                class="btn btn-danger text-white mt-1"
                                                onclick="return confirm('Yakin ingin menghapus <?= $u['nama']; ?>?');"><i
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