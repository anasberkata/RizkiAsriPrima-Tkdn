<?php
session_start();

include "../templates/header.php";

if (isset($_POST["edit_profile"])) {
    if (profile_edit($_POST) > 0) {
        echo "<script>
            alert('Profile berhasil diubah!');
            document.location.href = 'profile.php';
          </script>";
    } else {
        echo "<script>
            alert('Profile gagal diubah!');
            document.location.href = 'profile.php';
          </script>";
    }
}
?>


<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profile</h4>
                <img src="../assets/images/faces/<?= $user["image"] ?>" class="img-thumbnail">
                <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 rounded mt-3">
                    <div class="text-left">
                        <h6 class="mb-1">
                            <?= $user["nama"]; ?>
                        </h6>
                        <p class="text-muted mb-0">
                            <?= $user["username"]; ?>
                        </p>
                    </div>
                </div>
                <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 rounded mt-3">
                    <div class="text-left">
                        <h6 class="mb-1">
                            <?= $user["email"]; ?>
                        </h6>
                        <p class="text-muted mb-0">
                            <?= $user["role"]; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ubah Data</h4>
                <form class="forms-sample" action="" method="POST">
                    <input type="hidden" name="id_user" value="<?= $user["id_user"]; ?>">


                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $user["nama"]; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= $user["email"]; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username"
                                value="<?= $user["username"]; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password"
                                value="<?= $user["password"]; ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2" name="edit_profile">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include "../templates/footer.php";
?>