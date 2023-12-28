<?php
session_start();

include "../templates/header.php";

$produsen = query("SELECT * FROM produsen");

if (isset($_POST["add_bahan_baku"])) {
    if (bahan_baku_add($_POST) > 0) {
        echo "<script>
            alert('Bahan baku berhasil ditambah!');
            document.location.href = 'bahan_baku.php';
          </script>";
    } else {
        echo "<script>
            alert('Bahan baku gagal ditambah!');
            document.location.href = 'bahan_baku.php';
          </script>";
    }
}
?>


<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Bahan Baku</h4>
                <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="nama_bahan_baku" class="col-sm-3 col-form-label">Nama Bahan Baku</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_bahan_baku" name="nama_bahan_baku"
                                placeholder="Nama Bahan Baku">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="satuan" class="col-sm-3 col-form-label">Satuan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="satuan_input" placeholder="Tulis Satuan">
                            <select class="form-control" id="satuan" name="satuan_list">
                                <option value="Pcs">Pcs</option>
                                <option value="Lbr">Lbr</option>
                                <option value="Unit">Unit</option>
                                <option value="Btg">Btg</option>
                                <option value="Kg">Kg</option>
                                <option value="Roll">Roll</option>
                                <option value="Mtr">Mtr</option>
                                <option value="Bks">Bks</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="spesifikasi" class="col-sm-3 col-form-label">Spesifikasi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="produsen_id" class="col-sm-3 col-form-label">Produsen</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="produsen_id" name="produsen_id">
                                <option>Pilih Produsen</option>
                                <?php foreach ($produsen as $p): ?>
                                    <option value="<?= $p["id_produsen"]; ?>">
                                        <?= $p["nama_produsen"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_satuan" class="col-sm-3 col-form-label">Harga Satuan (Rp.)</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="harga_satuan" name="harga_satuan"
                                placeholder="Harga Satuan">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2" name="add_bahan_baku">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include "../templates/footer.php";
?>