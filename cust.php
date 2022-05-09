<?php

session_start();
if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

//koneksi kedatabase
require 'functions.php';


$jumlahdataperhalaman = 6;
$jumlahdata = count(query("SELECT * FROM customer"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$halamanaktif = (isset ($_GET["halaman"]) ) ? $_GET["halaman"] : 1 ;
//halaman = 2, awaldata = 3
//KONFIGURASI
$awaldata = ($jumlahdataperhalaman * $halamanaktif ) - $jumlahdataperhalaman;


//ambil data dari tabel sirestoran
// $customer = query("SELECT * FROM user");
// $result = mysqli_query($conn, "SELECT * FROM user")
$customer = query("SELECT * FROM customer LIMIT $awaldata, $jumlahdataperhalaman");

//$customer = query("SELECT * FROM customer);

//kalau mau cek error
// if( !$result) {
//     echo mysqli_error($conn); }

//tombo search ditekan
// if( isset($_POST["search"]) ) {
//     $customer = search($_POST["keyword"]);
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
if( isset($_POST["searchcust"]) ) {
    $customer = searchcust($_POST["keywordcust"]);
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

    <title>Customers | SI RESTORAN</title>
</head>
<body>
<div class="container3">
<h1>Daftar Customers</h1>
<a  href="home.html" class ="button1"> back to menu </a>

    <a href="tambahcust.php" class = "button"> + customer </a>


    <form align="center" action="" method="post">
        <input type="text" name="keywordcust" size="40" autofocus placeholder="insert keywords here" autocomplete="off">
        <button  type="submit" class="button" name="searchcust">search!</button>
        <br>
    </form>
    
    <!-- <form action="" method="post">
        <input type="text" name="keyword"sixe="40" autofocus placeholder="insert keywords here" autocomplete="off">
        <button type="submit" name="search">search!</button>
        <br>
    </form> -->
    

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


    <br>
    <table align="center" border="1">
        <tr>
            <th>Nomor</th>
            <th>id customer</th>
            <th>Nama Customer</th>
            <th>No Hp</th>
            <th>No Pesanan</th>
            <th><i>Action</i></th>

        </tr>

        <?php $i = 1; ?>
        <?php //while($row = mysqli_fetch_assoc($result))  : ?>
        <?php foreach ($customer as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
           
            <td><?= $row["id_customer"] ?></td>
            <td> <?= $row["nama_customer"]; ?> </td>
            <td> <?= $row["no_hp"]; ?> </td>
            <td> <?= $row["no_pesanan"]; ?> </td>
            <td>
                  <a href="ubahcust.php?id_customer=<?= $row["id_customer"]; ?>"onclick="return confirm('apa anda yakin akan mengubah data customer?');" class = "button">edit</a>
                <a href="hapuscust.php?id_customer=<?= $row["id_customer"]; ?>"onclick="return confirm('apa anda yakin akan menghapus customer?');" class = "button">delete</a>
            </td>
        </tr>
        
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
<footer><br><br><br><br></footer>
</html>