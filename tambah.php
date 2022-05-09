<?php


session_start();
if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require 'functions.php';

//cek apakah tobol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {

    
    //untuk cek apakan data berhasil ditambahkan atau tidak
    //var_dump(mysqli_affected_rows($conn));
    if( tambah($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil ditambahkan');
            document.location.href='index.php'
        </script>
        ";
    }else  {
       echo "
        <script>
           alert('data gagal ditambahkan');
           document.location.href='index.php'
        </script>
       ";
    }
    // if( mysqli_affected_rows($conn) > 0) {
    //     echo "data berhasil masuk";
    // }else  {
    //     echo "data gagal masuk";
    //     echo "<br>";
    //     echo mysqli_error($conn);
    // }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Tambah Menu | SI RESTORAN</title>
	<link rel="stylesheet" href="form.css">
    <!-- <link rel="stylesheet" href="read.css"> -->


</head>
<body>
<h2>TAMBAH MENU</h2>
<a  href="index.php"><button class="button1">KEMBALI</button></a><br><br>
<div>
    <form action="" width= "300px"  method="post" enctype="multipart/form-data">
    <table>
        <ul>
                <label for="kategori_menu">Kategori Menu :</label>
                <input width= "300px" type="text" name = "kategori_menu" id="kategori_menu" required> <br>
            <br>
                <label for="nama_menu">Nama Menu   :</label>
                <input type="text" name = "nama_menu" id="nama_menu" required>
            <br>
                <label  for="image"></label>
                <input type="hidden" name = "image" id="image" required>
            <br>
                <label for="harga">Harga     :</label>
                <input type="text" name = "harga" id="harga" required>
            <br>
                <button type="submit" name="submit"> Add Menu </button>
            </li>
        </ul>    
    </table>
    </form>
    
</body>
</html>