<?php
$conn = mysqli_connect("localhost", "root", "", "db_tkdn");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Tampilkan pesan kesalahan koneksi atau query
        die("Error in query: " . mysqli_error($conn));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// PROFILE
function profile_edit($data)
{
    global $conn;

    $id_user = $data["id_user"];
    $nama = $data["nama"];
    $email = $data["email"];
    $username = $data["username"];
    $password = $data["password"];

    $query = "UPDATE users SET
			nama = '$nama',
			email = '$email',
			username = '$username',
			password = '$password'

            WHERE id_user = $id_user
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

// PENGGUNA
function pengguna_add($data)
{
    global $conn;

    $nama = $data["nama"];
    $email = $data["email"];
    $username = $data["username"];
    $password = $data["password"];
    $role_id = $data["role_id"];

    $image = "avatar-default.jpg";

    $cek_username = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    $cek_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");

    // Cek Username Mahasiswa Sudah Ada Atau Belum
    if (mysqli_fetch_assoc($cek_username)) {
        echo "<script>
            alert('Username Sudah Terdaftar!');
            document.location.href = 'user_add.php';
            </script>";
    } else if (mysqli_fetch_assoc($cek_email)) {
        echo "<script>
            alert('Email Sudah Terdaftar!');
            document.location.href = 'user_add.php';
            </script>";
    } else {
        $query = "INSERT INTO users
				VALUES
			(NULL, '$nama','$email', '$username', '$password', '$image', '$role_id')
			";

        mysqli_query($conn, $query);
    }

    return mysqli_affected_rows($conn);
}

function pengguna_edit($data)
{
    global $conn;

    $id_user = $data["id_user"];
    $nama = $data["nama"];
    $email = $data["email"];
    $username = $data["username"];
    $password = $data["password"];
    $role_id = $data["role_id"];

    $query = "UPDATE users SET
			nama = '$nama',
			email = '$email',
			username = '$username',
			password = '$password',
			role_id = '$role_id'

            WHERE id_user = $id_user
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function pengguna_delete($id_user)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM users WHERE id_user = $id_user");
    return mysqli_affected_rows($conn);
}


// BAHAN BAKU
function produsen_add($data)
{
    global $conn;

    $nama_produsen = $data["nama_produsen"];
    $alamat = $data["alamat"];
    $negara = $data["negara"];
    $phone = $data["phone"];


    $query = "INSERT INTO produsen
				VALUES
			(NULL, '$nama_produsen','$alamat', '$negara', '$phone')
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function produsen_edit($data)
{
    global $conn;

    $id_produsen = $data["id_produsen"];
    $nama_produsen = $data["nama_produsen"];
    $alamat = $data["alamat"];
    $negara = $data["negara"];
    $phone = $data["phone"];

    $query = "UPDATE produsen SET
			nama_produsen = '$nama_produsen',
			alamat = '$alamat',
			negara = '$negara',
			phone = '$phone'

            WHERE id_produsen = $id_produsen
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function produsen_delete($id_produsen)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM produsen WHERE id_produsen = $id_produsen");
    return mysqli_affected_rows($conn);
}


// PRODUSEN
function bahan_baku_add($data)
{
    global $conn;

    $nama_bahan_baku = $data["nama_bahan_baku"];
    $satuan_input = isset($data["satuan_input"]) ? $data["satuan_input"] : "";
    $satuan_list = isset($data["satuan_list"]) ? $data["satuan_list"] : "";

    $satuan = !empty($satuan_input) ? $satuan_input : $satuan_list;

    $spesifikasi = $data["spesifikasi"];
    $foto = upload_bahan_baku();
    $produsen_id = $data["produsen_id"];
    $harga_satuan = $data["harga_satuan"];

    $query = "INSERT INTO bahan_baku
				VALUES
			(NULL, '$nama_bahan_baku', '$satuan', '$spesifikasi', '$foto', '$produsen_id', '$harga_satuan')
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function bahan_baku_edit($data)
{
    global $conn;

    $id_bahan_baku = $data["id_bahan_baku"];
    $nama_bahan_baku = $data["nama_bahan_baku"];

    $satuan_input = isset($data["satuan_input"]) ? $data["satuan_input"] : "";
    $satuan_list = isset($data["satuan_list"]) ? $data["satuan_list"] : "";
    $satuan = !empty($satuan_input) ? $satuan_input : $satuan_list;

    $spesifikasi = $data["spesifikasi"];

    $foto_lama = $data["foto_lama"];
    if ($_FILES["foto"]["error"] === 4) {
        $foto = $foto_lama;
    } else {
        $foto = upload_bahan_baku();
    }

    $produsen_id = $data["produsen_id"];
    $harga_satuan = $data["harga_satuan"];

    $query = "UPDATE bahan_baku SET
			nama_bahan_baku = '$nama_bahan_baku',
			satuan = '$satuan',
			spesifikasi = '$spesifikasi',
			foto = '$foto',
			produsen_id = '$produsen_id',
			harga_satuan = '$harga_satuan'

            WHERE id_bahan_baku = $id_bahan_baku
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function bahan_baku_delete($id_bahan_baku)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM bahan_baku WHERE id_bahan_baku = $id_bahan_baku");
    return mysqli_affected_rows($conn);
}


// PRODUK
function produk_add($data)
{
    global $conn;

    $nama_produk = $data["nama_produk"];
    $penanggung_jawab = $data["penanggung_jawab"];
    $tanggal = $data["tanggal"];

    $query = "INSERT INTO produk
                VALUES 
                (NULL, '$nama_produk', '$penanggung_jawab', '$tanggal')
            ";

    mysqli_query($conn, $query);

    // Mengambil ID produk yang baru ditambahkan
    $id_produk_baru = mysqli_insert_id($conn);

    return $id_produk_baru;
}

function produk_edit($data)
{
    global $conn;

    $id_produk = $data["id_produk"];
    $nama_produk = $data["nama_produk"];
    $penanggung_jawab = $data["penanggung_jawab"];
    $tanggal = $data["tanggal"];

    $query = "UPDATE produk SET
			nama_produk = '$nama_produk',
			penanggung_jawab = '$penanggung_jawab',
			tanggal = '$tanggal'

            WHERE id_produk = $id_produk
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function produk_delete($id_produk)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM dkb WHERE produk_id = $id_produk");
    mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id_produk");
    return mysqli_affected_rows($conn);
}

// DAFTAR KEBUTUHAN BAHAN
function dkb_add($data)
{
    global $conn;

    $produk_id = $data["produk_id"];
    $bahan_baku_id = $data["bahan_baku_id"];
    $tkdn = $data["tkdn"];
    $qty_pemakaian = $data["qty_pemakaian"];

    $dbb_result = mysqli_query($conn, "SELECT * FROM bahan_baku WHERE id_bahan_baku = '$bahan_baku_id'");
    $dbb = mysqli_fetch_assoc($dbb_result);

    $kdn = ($tkdn / 100) * $qty_pemakaian * $dbb["harga_satuan"];
    $kln = (1 - ($tkdn / 100)) * $qty_pemakaian * $dbb["harga_satuan"];
    $total = $kdn + $kln;

    $query = "INSERT INTO dkb
                VALUES 
                (NULL, '$bahan_baku_id', '$tkdn', '$qty_pemakaian', '$kdn', '$kln', '$total', '$produk_id')
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function dkb_edit($data)
{
    global $conn;

    $id_dkb = $data["id_dkb"];
    $produk_id = $data["produk_id"];
    $bahan_baku_id = $data["bahan_baku_id"];
    $tkdn = $data["tkdn"];
    $qty_pemakaian = $data["qty_pemakaian"];

    $dbb_result = mysqli_query($conn, "SELECT * FROM bahan_baku WHERE id_bahan_baku = '$bahan_baku_id'");
    $dbb = mysqli_fetch_assoc($dbb_result);

    $kdn = ($tkdn / 100) * $qty_pemakaian * $dbb["harga_satuan"];
    $kln = (1 - ($tkdn / 100)) * $qty_pemakaian * $dbb["harga_satuan"];
    $total = $kdn + $kln;

    $query = "UPDATE dkb SET
			bahan_baku_id = '$bahan_baku_id',
			tkdn = '$tkdn',
			qty_pemakaian = '$qty_pemakaian',
			kdn = '$kdn',
			kln = '$kln',
			total = '$total',
			produk_id = '$produk_id'

            WHERE id_dkb = $id_dkb
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function dkb_delete($id_dkb)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM dkb WHERE id_dkb = $id_dkb");
    return mysqli_affected_rows($conn);
}

// UPLOAD BAHAN BAKU
function upload_bahan_baku()
{
    $namaFile = $_FILES["foto"]["name"];
    $ukuranFile = $_FILES["foto"]["size"];
    $error = $_FILES["foto"]["error"];
    $tmpName = $_FILES["foto"]["tmp_name"];

    // if ($error === 4) {
    //     echo "<script>
    //             alert('Foto wajib diupload!');
    //         </script>";

    //     return false;
    // }

    $ekstensiFileValid = ["jpg"];
    $ekstensiFile = explode(".", $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
        echo "<script>
                alert('Gambar yang diupload bukan .jpg!');
            </script>";

        return false;
    }

    // max 10mb
    if ($ukuranFile > 20000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar, Maksimal 20mb!');
            </script>";

        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    move_uploaded_file($tmpName, "../assets/images/bahan_baku/" . $namaFileBaru);

    return $namaFileBaru;
}