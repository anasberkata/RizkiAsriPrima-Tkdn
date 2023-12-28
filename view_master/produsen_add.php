<?php
session_start();

include "../templates/header.php";

if (isset($_POST["add_produsen"])) {
    if (produsen_add($_POST) > 0) {
        echo "<script>
            alert('Produsen berhasil ditambah!');
            document.location.href = 'produsen.php';
          </script>";
    } else {
        echo "<script>
            alert('Produsen gagal ditambah!');
            document.location.href = 'produsen.php';
          </script>";
    }
}
?>


<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Produsen</h4>
                <form class="forms-sample" action="" method="POST">
                    <div class="form-group row">
                        <label for="nama_produsen" class="col-sm-3 col-form-label">Nama Produsen</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_produsen" name="nama_produsen"
                                placeholder="Nama Produsen">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="No. Telephone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="alamat" name="alamat" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="negara" class="col-sm-3 col-form-label">Negara</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="negara" name="negara" placeholder="Negara">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2" name="add_produsen">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include "../templates/footer.php";
?>