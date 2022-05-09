<?php

session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: index.html");
    exit;
}

require 'functions.php';

//NNAVIGASI HAL

$jumlahdataperhalaman = 5;
$jumlahdata = count(query("SELECT * FROM transaksi"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$halamanaktif = (isset ($_GET["halaman"]) ) ? $_GET["halaman"] : 1 ;
//halaman = 2, awaldata = 3
//KONFIGURASI
$awaldata = ($jumlahdataperhalaman * $halamanaktif ) - $jumlahdataperhalaman;



//ambil data transaksi dalam tabel transaksi
$transaksi = query("SELECT * FROM transaksi         
                            INNER JOIN reservasi ON transaksi.id_reservasi = reservasi.id_reservasi
                            INNER JOIN user ON transaksi.id_user = user.id_user
                            INNER JOIN customer ON transaksi.no_pesanan = customer.no_pesanan
                            INNER JOIN menu ON transaksi.id_menu = menu.id_menu
                            ORDER BY id_transaksi ASC LIMIT $awaldata, $jumlahdataperhalaman
                            ");

//ambil data dari jenis dalam tabel jenis
// $jenis = query("SELECT * FROM jenis");

//ambil data diurl
// $id_jenis = $_GET["jenis_obat"];

//query data obat
// $transaksi = query("SELECT * FROM transaksi INNER JOIN transaksi ON ");

// $transaksi = ("SELECT transaksi.no_transaksi, obat.kode_obat, jenis.jenis_obat FROM  transaksi, obat, jenis WHERE transaksi.no_transaksi,obat.kode_obat, jenis.id_jenis")[0];


//ambil data fetch transaksi dari objek result
// mysqli_fetch_assoc()

//ketika search ditekan
if( isset($_POST["searchtransaksi"]) ) {
    $transaksi = searchtransaksi($_POST["keywordtransaksi"]);
}


//COOKIE
//informasi yang diakses dimana saja dalam halaman browser/client
//jadi client bisa memanipulasi cookie CRUD hingga menjadi celah keamanan
//remember me? digunakan agar user tidak terus login 
//untuk mengenali user jadi browser tau siaapa yang sedang akses
//shopping cart fitur yang memungkinkan mencari barang kehalaman yang lain tanpa menghilangkan belanjaan yang dipilih sebelumnya
//personalisasi = mengetahui prilaku user, misal dalam iklan 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-home.css">
    <link rel="stylesheet" href="read.css">

    <title> Laporan | SI RESTORAN</title>
</head>
<body> 
<div class="container3">
<h1>Laporan Transaksi</h1>
<!--     
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
            <a class="navbar-brand text-black" >Toko Almas</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <button type="button" class="btn btn-light"><a href="menu.php" style="font-size: 15px;">Back to Menu</a></button>
                    </li>
                </ul>
            </div>
        </nav>
    </header> -->
    <a  href="home.html" class ="button1"> back to menu </a><br>

    <a href="tambahtran.php" class ="button"> + transaksi </a><br>

    <form align="center" action="" method="post">
        <input type="text" class="input"  name="keywordtransaksi" size="40" autofocus placeholder="insert keywords here" autocomplete="off">
        <button type="submit" class="button" name="searchtransaksi">search!</button>
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



    <table align="center" border="1" >
    <tr>
        <th>Nomor</th>
        <th><i>ID Transaksi</i></th>
        <th>Meja Reservasi</th>
        <th> Pegawai</th>
        <th> Tanggal</th>
        <th> No Pesanan</th>
        <th> Pelanggan </th>
        <th> Pesanan</th>
        <th> Jumlah</th>
        <th> Total</th>
        <th>actions</th>

    </tr>

    <?php $i = 1; ?>
    <?php foreach($transaksi as $data) : ?>
   
    
    <tr>
    <td> <?= $i; ?></td>
    
    <td><?= $data["id_transaksi"] ?></td>
    <td><?= $data["no_meja"] ?> </td>
    <td><?= $data["username"] ?> </td>
    <td><?= $data["tanggal"] ?> </td>
    <td><?= $data["no_pesanan"] ?> </td>
    <td><?= $data["nama_customer"] ?> </td>
    <td><?= $data["nama_menu"] ?> </td>
    <td><?= $data["jumlah"] ?> </td>
    <td><?= $data["total"] ?> </td>
    <td>
        <a href="hapustrans.php?id_transaksi=<?= $data["id_transaksi"]; ?>"onclick="return confirm('apakan anda yakin akan menghapus data?');">delete </a>
    </td>
    </tr>
    
    <?php $i++; ?>
        <?php endforeach; ?>
    </table>

</body>
<footer>
<br><br><br><br>
</footer>

</html>