<?php
include 'koneksi.php';
session_start();
//aksi untuk tambah

if (isset($_GET['pesanId'])) {
    $id = $_GET['pesanId'];
    $selectContact = mysqli_query($koneksi, "SELECT * FROM contact WHERE id = $id");
    $rowContact = mysqli_fetch_assoc($selectContact);
}

if (isset($_POST['send']) && ($_GET['pesanId'])) {
    $id = $_GET['pesanId'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $reply = $_POST['reply'];

    $headers = "From: dhntrama@gmail.com" . "\r\n" .
        "Reply-To: dhntrama@gmail.com" . "\r\n" .
        "Content-Type: text/plain; charset=UTF8" . "\r\n" .
        "MIME-Version: 1.0" . "\r\n";

    if (mail($email, $subject, $reply, $headers)) {
        echo "Berhasil";
        header("location: contact-admin.php?status=berhasil-terkirim");
        exit();
    } else {
        echo "Gagal";
        header("location: kirim-pesan.php?status=gagal-terkirim");
    }
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
                                        <div class="card-header">Balas Pesan</div>
                                        <div class="table-responsive text-nowrap">
                                            <ul style="list-style-type:'-'">
                                                <pre>
                                                <li>Nama   :<?php echo $rowContact['name'] ?></li>
                                                <li>Email  :<?php echo $rowContact['email'] ?></li>
                                                <li>Subjek :<?php echo $rowContact['subject'] ?></li>
                                                <li>Message:<?php echo $rowContact['message'] ?></li>
                                                </pre>
                                            </ul>
                                            <?php if (isset($_GET['hapus'])):  ?>
                                                <!-- <div class="alert alert-primary" role="alert">Data Berhasil Dihapus</div> -->
                                            <?php endif ?>
                                        </div>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <label for="" class="col-form-label">Nama</label>
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                        <input type="text" class="form-control" name="email" placeholder="Masukkan Nama" value="<?php echo $rowContact['email'] ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="col-sm-6">
                                                    <label for="" class="col-form-label">Subject</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                        <input type="text" class="form-control" name="subject" placeholder="Masukkan Judul" value="<?php echo $rowContact['subject'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="" class="col-form-label">Balas Pesan</label>
                                                    <div class="input-group input-group-merge">
                                                        <textarea name="reply" cols="30" rows="10" class="form-control" id=""></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary" name="send" type="submit">
                                                    Send
                                                </button>
                                                <button class="btn btn-secondary" name="" type="">
                                                    <a href="contact-admin.php" class="text-white">Kembali</a>
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