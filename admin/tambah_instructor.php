<?php
include 'koneksi.php';
session_start();
//aksi untuk tambah
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];


    //$_POST: form input name=''
    //$_GET: url ?param='nilai'
    //$_FILES : ngambil nilai dari input type file

    if (!empty($_FILES['foto']['name'])) {
        $photos = $_FILES['foto']['name'];
        $photosSize = $_FILES['foto']['size'];

        $ext = array('png', 'jpg', 'jpeg');
        $extFoto = pathinfo($photos, PATHINFO_EXTENSION);

        //Jika extensi foto tidak memenuhi syarat array extensi
        if (!in_array($extFoto, $ext)) {
            echo "Gunakan Foto Lain";
            die;
        } else {
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $photos);  //memindahkan foto ke folder upload
            $insert = mysqli_query($koneksi, "INSERT INTO instructors (nama, jurusan, foto) VALUES ('$nama', '$jurusan', '$photos')");
        }
    } else {
        // sql = structur query languages / DML = data manipulation language
        // select, insert. update, dan delete
        $insert = mysqli_query($koneksi, "INSERT INTO instructors (nama, jurusan) VALUES ('$nama', '$jurusan')");
    }

    header("location:instructor.php?tambah=berhasil");
}

//aksi untuk edit
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($koneksi, "SELECT * FROM instructors WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];

    //jika user ingin memasukkan gambar
    if (!empty($_FILES['foto']['name'])) {
        $photos = $_FILES['foto']['name'];
        $photosSize = $_FILES['foto']['size'];

        $ext = array('png', 'jpg', 'jpeg');
        $extFoto = pathinfo($photos, PATHINFO_EXTENSION);
        if (!in_array($extFoto, $ext)) {
            echo "Gunakan Foto Lain";
            die;
        } else {
            unlink('upload/' . $rowEdit['foto']);
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $photos);  //memindahkan foto ke folder upload
            $update = mysqli_query($koneksi, "UPDATE instructors SET nama='$nama', jurusan='$jurusan', foto ='$photos' WHERE id='$id'");
        }
    } else {

        // kalau user tidak ingin memasukkan gambar\
        $update = mysqli_query($koneksi, "UPDATE instructors SET nama='$nama', jurusan='$jurusan' WHERE id='$id'");
    }
    header("location:instructor.php?edit=berhasil");
}


?>

<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/admin/assets//admin/assets//"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />
    <?php include 'inc/head.php'; ?>

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include 'inc/aside.php'; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include 'inc/nav.php'; ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <!--/ Total Revenue -->
                            <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
                                <div class="row">
                                    <div class="col-sm-12 card">
                                        <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Instructors</div>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="" class="col-form-label">Nama</label>
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" value="<?php echo isset($_GET['edit']) ? $rowEdit['nama'] : '' ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="" class="col-form-label">Jurusan</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                        <input type="jurusan" class="form-control" name="jurusan" placeholder="Masukkan jurusan" value="<?php echo isset($_GET['edit']) ? $rowEdit['jurusan'] : '' ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="mb-3">
                                                <div class="col-sm-12">
                                                    <label for="" class="col-form-label">Password</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text tf-icon bx bx-pencil bx-18px"></span>
                                                        <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="mb-3">
                                                <div class="col-sm-12">
                                                    <label for="" class="col-form-label">Upload Photo</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text tf-icon bx bx-pencil bx-18px"></span>
                                                        <input type="file" name="foto">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">
                                                    Simpan
                                                </button>
                                                <button class="btn btn-secondary" name="" type="">
                                                    <a href="instructor.php" class="text-white">Kembali</a>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                            </div>
                            <div class="row">

                            </div>
                        </div>
                        <!-- / Content -->

                        <!-- Footer -->
                        <?php include 'inc/footer.php'; ?>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->


        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <?php include 'inc/js.php'; ?>
</body>

</html>