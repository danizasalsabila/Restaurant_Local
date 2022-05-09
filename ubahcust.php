<?php


session_start();
if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require 'functions.php';


//ambil data diurl
$id_customer=$_GET["id_customer"];

//query data customer berdasarkan id_customer
$m = query("SELECT * FROM customer WHERE id_customer = $id_customer")[0];

//cek apakah tobol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
    
    //untuk cek apakan data berhasil diubahkan atau tidak
    //var_dump(mysqli_affected_rows($conn));
    if( ubahcust($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil diubah');
            document.location.href='cust.php'
        </script>
        ";
    }else  {
       echo "
        <script>
           alert('data gagal diubah');
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
<title>Ubah Data Customers | SI RESTORAN</title>
	<link rel="stylesheet" href="form.css">
</head>
<body>
<h1>Ubah customer</h1><br>
<a href="cust.php"><button>KEMBALI</button></a>
    <form action="" method="post">
    <input type="hidden" name="id_customer" value="<?= $m["id_customer"]; ?>">
        <ul>
                <label for="nama_customer">Nama customer   :</label><br>
                <input type="text" name = "nama_customer" id="nama_customer" required value="<?= $m["nama_customer"]; ?>"><br>
            <br>
                <label for="no_hp">no_hp     :</label><br>
                <input type="text" name = "no_hp" id="no_hp" required value="<?= $m["no_hp"]; ?>"><br>
            <br>
                <label for="no_pesanan">no_pesanan     :</label><br>
                <input type="text" name = "no_pesanan" id="no_pesanan" required value="<?= $m["no_pesanan"]; ?>"><br>
            
                <br><button type="submit" name="submit"> Ubah customer </button>
        </ul>    
    </form>
    
</body>
</html>