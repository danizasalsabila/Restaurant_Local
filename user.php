<?php

session_start();
if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

//koneksi kedatabase
require 'functions.php';



//ambil data dari tabel sirestoran
// $user = query("SELECT * FROM user");
// $result = mysqli_query($conn, "SELECT * FROM user")
$user = query("SELECT * FROM user");

//$user = query("SELECT * FROM user);

//kalau mau cek error
// if( !$result) {
//     echo mysqli_error($conn); }

//tombo search ditekan
// if( isset($_POST["search"]) ) {
//     $user = search($_POST["keyword"]);
//   }
//ambil data tabel dari object rusult
//ambil data (fetch) mahasiswa dari object result
//mysqli_fetch_row() //mengembalikan array numerik menggunakan angka, elemen menggunakan angka sebagai nomor index
//contoh
// $a = mysqli_fetch_row($result);
// var_dump($a);
//mysqli_fetch_assoc() mengembalikan array semua datanya menggunakan huruf, misal jika ingin menampilkan kolom nama saja, maka (nama)
// while ($m = mysqli_fetch_assoc($result) ) {
//     var_dump($m);
// }
//mysqli_fetch_array() mengembalikan  array semua datanya mengggunakan huruf atau angka
//kekurangan data yang disajikan jadi double
//mysqli_fetch_object() seperti array tapi menggunakan panah, ex: (a->nama_menu) 

// //saat tombol cari ditekan
if( isset($_POST["searchuser"]) ) {
    $user = searchuser($_POST["keyworduser"]);
  }
// ?>







<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-home.css">
    <link rel="stylesheet" href="read.css">

    <title>User | SI RESTORAN</title>
</head>

<body>
<div class="container3">
<h1>Data Pegawai</h1>
<a  href="home.html" class ="button1"> back to menu </a>

<a href="registrasi.php" class = "button"> + user </a>

    <br> <br>

    <form align="center" action="" method="post">
        <input type="text" name="keyworduser"size="40" autofocus placeholder="insert keywords here" autocomplete="off">
        <button class="button" type="submit" name="searchuser">search!</button>
        <br>
    </form>

    <br>
    <table align="center" border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Nomor</th>
            <th>id user</th>
            <th>Nama Pegawai</th>
            <th>jabatan</th>
            <th><i>Action</i></th>

        </tr>

        <?php $i = 1; ?>
        <?php //while($row = mysqli_fetch_assoc($result))  : ?>
        <?php foreach ($user as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            
            <td><?= $row["id_user"] ?></td>
            <td> <?= $row["username"]; ?> </td>
            <td> <?= $row["jabatan"]; ?> </td>
            <td>               
             <a href="ubahuser.php?id_user=<?= $row["id_user"]; ?>"onclick="return confirm('apa anda yakin akan mengubah user?');" class = "button">ubah</a>

                <a href="hapususer.php?id_user=<?= $row["id_user"]; ?>"onclick="return confirm('apa anda yakin akan menghapus user?');" class = "button">delete</a>
            </td>
        </tr>
        
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>

</html>