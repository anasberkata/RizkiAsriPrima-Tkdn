<?php
session_start();

include "../templates/header.php";

$karyawan = query("SELECT * FROM users WHERE role_id = 3");
$produsen = query("SELECT * FROM produsen");
$produk = query("SELECT * FROM produk");
$bahan_baku = query("SELECT * FROM bahan_baku");

$total_karyawan = count($karyawan);
$total_produsen = count($produsen);
$total_produk = count($produk);
$total_bahan_baku = count($bahan_baku);

$produk = query(
    "SELECT * FROM produk
    INNER JOIN users ON produk.penanggung_jawab = users.id_user
    ORDER BY tanggal DESC
    ");
?>

<div class="row">
    <div class="col-sm-4 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Karyawan</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">
                                <?= $total_karyawan; ?> Karyawan
                            </h2>
                        </div>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-account text-primary ms-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Produsen</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">
                                <?= $total_produsen; ?> Produsen
                            </h2>
                        </div>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi mdi-vector-combine text-danger ms-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Data Produk</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">
                                <?= $total_produk; ?> Produk
                            </h2>
                        </div>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi mdi-view-grid text-success ms-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5>Bahan Baku</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">
                                <?= $total_bahan_baku; ?> Bahan
                            </h2>
                        </div>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi mdi-view-dashboard text-primary ms-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title mb-1">Data Produk</h4>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="preview-list">
                            <?php foreach ($produk as $p): ?>
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-primary">
                                            <i class="mdi mdi-file-document"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">
                                                <?= $p["nama_produk"]; ?>
                                            </h6>
                                            <p class="text-muted mb-0">Penanggung Jawab :
                                                <?= $p["nama"]; ?>
                                                <br>
                                                Tanggal :
                                                <?= $p["tanggal"]; ?>
                                            </p>
                                        </div>
                                        <div class="me-auto text-sm-right pt-2 pt-sm-0">
                                            <a href="../view_dkb/dkb.php?id_produk=<?= $p["id_produk"] ?>"
                                                class="btn btn-success text-white mt-1"><i class="mdi mdi-view-list"></i>
                                                Lihat Daftar Kebutuhan Bahan</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include "../templates/footer.php";
?>