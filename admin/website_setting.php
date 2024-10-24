<?php
include 'koneksi.php';
session_start();
//aksi untuk tambah
$querySetting = mysqli_query($koneksi, "SELECT * FROM general_setting ORDER BY id DESC");
if (isset($_POST['simpan'])) {
    $website_name    = $_POST['website_name'];
    $website_link    = $_POST['website_link'];
    $website_email   = $_POST['website_email'];
    $website_phone   = $_POST['website_phone'];
    $website_address = $_POST['website_address'];
    $id              = $_POST['id'];

    //mencari data di dalam table pengaturan, jika ada data akan di update, jika tidak ada maka akan diinsert 

    if (mysqli_num_rows($querySetting) > 0) {
        if (!empty($_FILES['logo']['name'])) {
            $logo = $_FILES['logo']['name'];
            $logoSize = $_FILES['logo']['size'];

            $ext = array('png', 'jpg', 'jpeg');
            $extLogo = pathinfo($logo, PATHINFO_EXTENSION);

            //Jika extensi logo tidak memenuhi syarat array extensi
            if (!in_array($extLogo, $ext)) {
                echo "Gunakan Foto Lain";
                die;
            } else {
                move_uploaded_file($_FILES['logo']['tmp_name'], 'upload/' . $logo);  //memindahkan foto ke folder upload
                $update = mysqli_query($koneksi, "UPDATE general_setting SET website_name='$website_name', website_link='$website_link', website_phone='$website_phone', website_email='$website_email', website_address='$website_address' logo='$logo' WHERE id = '$id'");
            }
        } else {
            // sql = structur query languages / DML = data manipulation language
            // select, insert. update, dan delete
            $update = mysqli_query($koneksi, "UPDATE general_setting SET website_name='$website_name', website_link='$website_link', website_phone='$website_phone', website_email='$website_email', website_address='$website_address' WHERE id = '$id'");
        }
    } else {
        if (!empty($_FILES['logo']['name'])) {
            $logo = $_FILES['logo']['name'];
            $logoSize = $_FILES['logo']['size'];

            $ext = array('png', 'jpg', 'jpeg');
            $extLogo = pathinfo($logo, PATHINFO_EXTENSION);

            //Jika extensi logo tidak memenuhi syarat array extensi
            if (!in_array($extLogo, $ext)) {
                echo "Gunakan Foto Lain";
                die;
            } else {
                move_uploaded_file($_FILES['logo']['tmp_name'], 'upload/' . $logo);  //memindahkan foto ke folder upload
                $insert = mysqli_query($koneksi, "INSERT INTO general_setting (website_name, website_link, website_phone ,website_email, website_address, logo) VALUES ('$website_name', '$website_link', '$website_phone', '$website_email', '$website_address', '$logo')");
            }
        } else {
            // sql = structur query languages / DML = data manipulation language
            // select, insert. update, dan delete
            $insert = mysqli_query($koneksi, "INSERT INTO general_setting (website_name, website_link, website_phone, website_email, website_address) VALUES ('$website_name', '$website_link', '$website_phone', '$website_email', '$website_address')");
        }
    }
    header("location:website_setting.php?tambah=berhasil");
}

$rowSetting = mysqli_fetch_assoc($querySetting);

//aksi untuk edit
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    //jika password diisi dengan user
    if ($_POST['password']) {
        $password = $_POST['password'];
    } else {
        $password = $rowEdit['password'];
    }

    $update = mysqli_query($koneksi, "UPDATE user SET nama='$nama', email='$email', password='$password' WHERE id='$id'");
    header("location:user.php?edit=berhasil");
}


?>

<!DOCTYPE html>
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
                                        <div class="card-header">Pengaturan Website</div>
                                        <div class="table-responsive text-nowrap">
                                            <?php if (isset($_GET['hapus'])):  ?>
                                                <div class="alert alert-primary" role="alert">Data Berhasil Dihapus</div>
                                            <?php endif ?>
                                        </div>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo isset($rowSetting['id']) ? $rowSetting['id'] : '' ?>" required>
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="col-form-label">Website Name</label>
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                            <input type="text" class="form-control" name="website_name" placeholder="Masukkan Nama Website" value="<?php echo isset($rowSetting['website_name']) ? $rowSetting['website_name'] : '' ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="col-form-label">Website Phone</label>
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                                            <input type="text" class="form-control" name="website_phone" placeholder="Masukkan Telepon" value="<?php echo isset($rowSetting['website_phone']) ? $rowSetting['website_phone'] : '' ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="col-form-label">Website Link</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                            <input type="url" class="form-control" name="website_link" placeholder="Masukkan Link Website" value="<?php echo isset($rowSetting['website_link']) ? $rowSetting['website_link'] : '' ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="col-form-label">Email Website</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                            <input type="email" class="form-control" name="website_email" placeholder="Masukkan Email Website" value="<?php echo isset($rowSetting['website_email']) ? $rowSetting['website_email'] : '' ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="col-sm-12">
                                                    <label for="" class="col-form-label">Website Address</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text tf-icon bx bx-pencil bx-18px"></span>
                                                        <input type="text" class="form-control" name="website_address" placeholder="Masukkan Address" value="<?php echo isset($rowSetting['website_address']) ? $rowSetting['website_address'] : '' ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="col-sm-12">
                                                    <label for="" class="col-form-label">Upload Photo</label>
                                                    <div class="input-group input-group-merge">
                                                        <img
                                                            src="<?php echo isset($rowSetting['logo']) ? $rowSetting['logo'] : '' ?>"
                                                            alt="user-avatar"
                                                            class="d-block rounded"
                                                            height="100"
                                                            width="100"
                                                            id="uploadedAvatar" />
                                                        <input type="file" name="logo">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">
                                                    Simpan
                                                </button>
                                                <button class="btn btn-secondary" name="" type="">
                                                    <a href="user.php" class="text-white">Kembali</a>
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