<?php

session_start();
if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

//koneksi kedatabase
require 'functions.php';




$jumlahdataperhalaman = 5;
$jumlahdata = count(query("SELECT * FROM reservasi"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$halamanaktif = (isset ($_GET["halaman"]) ) ? $_GET["halaman"] : 1 ;
//halaman = 2, awaldata = 3
//KONFIGURASI
$awaldata = ($jumlahdataperhalaman * $halamanaktif ) - $jumlahdataperhalaman;








//ambil data dari tabel sirestoran
// $reservasi = query("SELECT * FROM user");
// $result = mysqli_query($conn, "SELECT * FROM user")
$reservasi = query("SELECT * FROM reservasi");

//$reservasi = query("SELECT * FROM reservasi);

//kalau mau cek error
// if( !$result) {
//     echo mysqli_error($conn); }

//tombo search ditekan
// if( isset($_POST["search"]) ) {
//     $reservasi = search($_POST["keyword"]);
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
if( isset($_POST["searchres"]) ) {
    $reservasi = searchres($_POST["keywordres"]);
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


    <title> Halaman Reservasi | SI RESTORAN</title>
</head>
<body>
<div class="container3">
<h1>Daftar Reservasi</h1>
<a  href="home.html" class ="button1"> back to menu </a>

    <a href="tambahres.php"  class ="button"> + reservasi </a>


    <form action="" align ="center" method="post">
        <input type="text" name="keywordres"size="40" autofocus placeholder="insert keywords here" autocomplete="off">
        <button type="submit" class="button" name="searchres">search</button>
        <br>
    </form>

    
    <!-- NAVIGASI HALAMAN -->
    <?php if($halamanaktif>1) : ?>
        <a href="?halaman= <?= $halamanaktif - 1; ?> "> &laquo; </a>
    <?php endif; ?>

    <?php for($i=1; $i<=$jumlahhalaman; $i++) : ?>
        <?php if($i == $halamanaktif) : ?>
            <a href="?halaman= <?= $i;  ?>" style="font-weight :bold; 
            "> <?= $i; ?> </a>
        <?php else : ?>
            <a href="?halaman= <?= $i;  ?>"> <?= $i; ?> </a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if($halamanaktif<$jumlahhalaman) : ?>
        <a href="?halaman= <?= $halamanaktif + 1; ?> "> &raquo; </a>
    <?php endif; ?>


    <table align="center"border="1" >
        <tr>
            <th>Nomor</th>
            <th>id reservasi</th>
            <th>No meja</th>
            <th><i>Action</i></th>

        </tr>

        <?php $i = 1; ?>
        <?php //while($row = mysqli_fetch_assoc($result))  : ?>
        <?php foreach ($reservasi as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            
            <td><?= $row["id_reservasi"] ?></td>
            <td> <?= $row["no_meja"]; ?> </td>
            <td>
                  <a class ="button" href="ubahres.php?id_reservasi=<?= $row["id_reservasi"]; ?>"onclick="return confirm('apa anda yakin akan mengubah data reservasi?');">edit</a>
                <a class ="button" href="hapusres.php?id_reservasi=<?= $row["id_reservasi"]; ?>"onclick="return confirm('apa anda yakin akan menghapus reservasi?');">delete</a>
            </td>
        </tr>
        
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
<footer><br><br><br><br></footer>
</html>