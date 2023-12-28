<?php
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id = $_SESSION['id'];
$user = query(
    "SELECT * FROM users
    INNER JOIN users_role ON users.role_id = users_role.id_role
    WHERE id_user = $id"
)[0];

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rizky Asri Prima - TKDN</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/logo-pic.png" />
    <style>
        .table td img {
            width: 90px;
            height: 90px;
            border-radius: 15px;
        }

        .form-control {
            background-color: #ffffff;
            color: #212529;
        }

        .form-control:focus {
            background-color: #ffffff;
            color: #212529;
        }

        input:focus {
            background-color: #ffffff;
            color: #212529;
        }
    </style>

    <link href="../vendor/datatables/datatables.min.css" rel="stylesheet">
    <link href="../vendor/datatables/Buttons-2.4.2/buttons.dataTables.min.css" rel="stylesheet">
</head>

<body>

    <?php
    include "../templates/sidebar.php";
    include "../templates/nav.php";
    ?>

    <div class="main-panel">
        <div class="content-wrapper">