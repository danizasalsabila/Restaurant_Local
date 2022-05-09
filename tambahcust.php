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
    if( tambahcust($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil ditambahkan');
            document.location.href='cust.php'
        </script>
        ";
    }else  {
       echo "
        <script>
           alert('data gagal ditambahkan');
           document.location.href='cust.php'
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
    
<title>Tambah Customer | SI RESTORAN</title>
<link rel="stylesheet" href="form.css">

</head>
<body>
<h2>Tambah Customer</h2>
<a href="cust.php"><button>KEMBALI</button></a>
<div>
    <form action="" method="post">
        <ul>
                <label for="nama_customer">nama_customer :</label><br>
                <input width="30px" type="text" name = "nama_customer" id="nama_customer" required><br>
            <br>
                <label for="no_hp">no_hp   :</label><br>
                <input type="text" name = "no_hp" id="no_hp" required><br>
            <br>
                <label for="no_pesanan">No Pesanan     :</label><br>
                <input type="text" name = "no_pesanan" id="no_pesanan" required><br>
            <br>
                <button type="submit" name="submit"> Add Menu </button>
            </li>
        </ul>    
    </form>
    
</body>
</html>