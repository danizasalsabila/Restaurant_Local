<?php
//koneksi kedatabase
$conn = mysqli_connect("localhost","root","","sirestoran");

//ambil data dari tabel sirestoran
$result = mysqli_query($conn, "SELECT * FROM menu" );

//kalau mau cek error
// if( !$result) {
//     echo mysqli_error($conn); }

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


?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Users</title>
</head>
<body>
    <h1 style="text-align: center;"> Daftar Menu </h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Nomor</th>
            <th><i>Action</i></th>
            <th>Kategori Menu</th>
            <th>Nama Menu</th>
            <th><i>Image</i></th>
            <th>Harga</th>
        </tr>

        <?php $i = 1; ?>
        <?php while( $row = mysqli_fetch_assoc($result))  : ?>
        
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="">change</a>
                <a href="">delete</a>
            </td>
            <td> <?= $row["kategori_menu"]; ?> </td>
            <td> <?= $row["nama_menu"]; ?> </td>
            <td><img src=""> <?= $row["image"]; ?> </td>
            <td> <?= $row["harga"]; ?> </td>
        </tr>
        
        <?php $i++; ?>
        <?php endwhile; ?>
    </table>
</body>
</html>