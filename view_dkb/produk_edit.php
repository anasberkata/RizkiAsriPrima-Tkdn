<?php
session_start();

include "../templates/header.php";

$id_produk = $_GET["id_produk"];
$p = query(
    "SELECT * FROM produk
    INNER JOIN users ON produk.penanggung_jawab = users.id_user
    WHERE id_produk = $id_produk"
)[0];

$penganggung_jawab = query(
    "SELECT * FROM users
    INNER JOIN users_role ON users.role_id = users_role.id_role
    WHERE NOT role_id = 1
    ");

$roles = query("SELECT * FROM users_role");

if (isset($_POST["edit_produk"])) {
    if (produk_edit($_POST) > 0) {
        echo "<script>
            alert('Produk berhasil diubah!');
            document.location.href = 'produk.php';
          </script>";
    } else {
        echo "<script>
            alert('Produk gagal diubah!');
            document.location.href = 'produk.php';
          </script>";
    }
}
?>


<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ubah Produk</h4>
                <form class="forms-sample" action="" method="POST">
                    <input type="hidden" name="id_produk" value="<?= $p["id_produk"]; ?>">

                    <div class="form-group row">
                        <label for="nama_produk" class="col-sm-3 col-form-label">Nama Produk</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                value="<?= $p["nama_produk"]; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penganggung_jawab" class="col-sm-3 col-form-label">Penanggung Jawab</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="penanggung_jawab" name="penanggung_jawab">
                                <option value="<?= $p["penanggung_jawab"]; ?>">
                                    <?= $p["nama"]; ?>
                                </option>
                                <?php foreach ($penganggung_jawab as $pj): ?>
                                    <option value="<?= $pj["id_user"]; ?>">
                                        <?= $pj["nama"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="<?= $p["tanggal"]; ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2" name="edit_produk">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include "../templates/footer.php";
?>