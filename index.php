<?php
session_start();

if (isset($_SESSION['login'])) {
  header("Location: view_admin/dashboard.php");
  exit;
}

include "templates/auth-header.php";
?>

<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="row w-100 m-0">
      <div class="content-wrapper full-page-wrapper d-flex align-items-center auth bg-light">
        <div class="card col-lg-4 mx-auto">
          <div class="card-body px-5 py-5">
            <div class="text-center">
              <img src="assets/images/logo-pic.png" width="20%">
              <h3 class="card-title text-left mt-5 mb-0">TKDN</h3>
              <p class="mb-4">Tingkat Komponen Dalam Negeri</p>
            </div>

            <?php if (isset($_GET["pesan"])): ?>
              <p class=" alert alert-danger" style="font-style: italic; color: red; text-align: center;">
                <?= $_GET["pesan"]; ?>
              </p>
            <?php endif; ?>

            <form action="cek_login.php" method="POST">
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control p_input" name="username" placeholder="Username">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control p_input" name="password" placeholder="Password">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- row ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<?php
include "templates/auth-footer.php";
?>