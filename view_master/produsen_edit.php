<?php
session_start();

include "../templates/header.php";

$id_produsen = $_GET["id_produsen"];
$p = query(
    "SELECT * FROM produsen
    WHERE id_produsen = $id_produsen"
)[0];

if (isset($_POST["edit_produsen"])) {
    if (produsen_edit($_POST) > 0) {
        echo "<script>
            alert('Produsen berhasil diubah!');
            document.location.href = 'produsen.php';
          </script>";
    } else {
        echo "<script>
            alert('Produsen gagal diubah!');
            document.location.href = 'produsen.php';
          </script>";
    }
}
?>


<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ubah Produsen</h4>
                <form class="forms-sample" action="" method="POST">
                    <input type="hidden" name="id_produsen" value="<?= $p["id_produsen"]; ?>">

                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama_produsen"
                                value="<?= $p["nama_produsen"]; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?= $p["phone"]; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="alamat" name="alamat" rows="4"
                                value="<?= $p["alamat"]; ?>"><?= $p["alamat"]; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="negara" class="col-sm-3 col-form-label">Negara</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="negara" name="negara"
                                value="<?= $p["negara"]; ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2" name="edit_produsen">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include "../templates/footer.php";
?>