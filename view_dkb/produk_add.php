<?php
session_start();

include "../templates/header.php";

$penganggung_jawab = query(
    "SELECT * FROM users
    INNER JOIN users_role ON users.role_id = users_role.id_role
    WHERE NOT role_id = 1
    ");

if (isset($_POST["add_produk"])) {
    $id_produk_baru = produk_add($_POST);

    if ($id_produk_baru > 0) {
        echo "
                <script>
                    alert('Produk berhasil ditambah!');
                    document.location.href = 'dkb.php?id_produk=$id_produk_baru';
                </script>";
    } else {
        echo "
                <script>
                    alert('Produk gagal ditambah!');
                    document.location.href = 'produk.php';
                </script>";
    }
}

?>


<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Produk</h4>
                <form class="forms-sample" action="" method="POST">
                    <div class="form-group row">
                        <label for="nama_produk" class="col-sm-3 col-form-label">Nama Produk</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                placeholder="Nama Produk">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penganggung_jawab" class="col-sm-3 col-form-label">Penanggung Jawab</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="penanggung_jawab" name="penanggung_jawab">
                                <option>Pilih Penanggung Jawab</option>
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
                            <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2" name="add_produk">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include "../templates/footer.php";
?>