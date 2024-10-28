<?php

require_once "../admin/koneksi.php";
if (isset($_POST['simpan'])) {
    $name       = mysqli_real_escape_string($koneksi, $_POST['name']); //htmlspecialchars akan membuat karakter tanda kutip menjadi berubah d database
    $email      = htmlspecialchars($_POST['email']);
    $subject    = htmlspecialchars($_POST['subject']);
    $message    = htmlspecialchars($_POST['message']);

    $select = mysqli_query($koneksi, "SELECT email FROM contact WHERE email = '$email'"); //digunakan jika email sudah digunakan
    if (mysqli_num_rows($select) > 0) {
        header("location: ../contact.php?status=email-available");
        exit;
    } else { //jika email belum digunakan
        $insert = mysqli_query($koneksi, "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')");
        if ($insert) {
            header("location: ../contact.php?status=success");
            exit();
        }
    }
}
