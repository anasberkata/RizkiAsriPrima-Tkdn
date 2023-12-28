<?php
session_start();

include "../templates/header.php";

$id_produk = $_GET["id_produk"];

$bahan_baku = query(
    "SELECT * FROM bahan_baku
    INNER JOIN produsen ON bahan_baku.produsen_id = produsen.id_produsen
    ");

if (isset($_POST["add_dkb"])) {

    if (dkb_add($_POST) > 0) {
        echo "<script>
            alert('Bahan baku berhasil ditambah!');
            document.location.href = 'dkb.php?id_produk=$id_produk';
          </script>";
    } else {
        echo "<script>
            alert('Bahan baku gagal ditambah!');
            document.location.href = 'dkb.php?id_produk=$id_produk';
          </script>";
    }
}

?>


<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Bahan Baku</h4>
                <form class="forms-sample" action="" method="POST">
                    <input type="hidden" name="produk_id" value="<?= $id_produk; ?>">

                    <div class="form-group row">
                        <label for="bahan_baku_id" class="col-sm-3 col-form-label">Nama Bahan Baku</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="id_bahan_baku" name="bahan_baku_id">
                                <option>Pilih Bahan Baku</option>
                                <?php foreach ($bahan_baku as $bb): ?>
                                    <option value="<?= $bb["id_bahan_baku"]; ?>">
                                        <?= $bb["nama_bahan_baku"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tkdn" class="col-sm-3 col-form-label">TKDN (%)</label>
                        <div class="col-sm-9">
                            <input type="number" step="any" class="form-control" id="tkdn" name="tkdn"
                                placeholder="TKDN (%)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="qty_pemakaian" class="col-sm-3 col-form-label">Jumlah Pemakaian</label>
                        <div class="col-sm-9">
                            <input type="number" step="any" class="form-control" id="qty_pemakaian" name="qty_pemakaian"
                                placeholder="Jumlah Pemakaian">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2" name="add_dkb">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include "../templates/footer.php";
?>