<?php
session_start();

include "../templates/header.php";

$roles = query("SELECT * FROM users_role");

if (isset($_POST["add_user"])) {
    if (pengguna_add($_POST) > 0) {
        echo "<script>
            alert('Pengguna berhasil ditambah!');
            document.location.href = 'pengguna.php';
          </script>";
    } else {
        echo "<script>
            alert('Pengguna gagal ditambah!');
            document.location.href = 'pengguna.php';
          </script>";
    }
}
?>


<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Pengguna</h4>
                <form class="forms-sample" action="" method="POST">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="role" name="role_id">
                                <option>Pilih Role</option>
                                <?php foreach ($roles as $r): ?>
                                    <option value="<?= $r["id_role"]; ?>">
                                        <?= $r["role"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2" name="add_user">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include "../templates/footer.php";
?>