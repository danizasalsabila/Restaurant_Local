<?php


session_start();
if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require 'functions.php';


//ambil data diurl
$id_menu=$_GET["id_menu"];

//query data menu berdasarkan id_menu
$m = query("SELECT * FROM menu WHERE id_menu = $id_menu")[0];

//cek apakah tobol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
    
    //untuk cek apakan data berhasil diubahkan atau tidak
    //var_dump(mysqli_affected_rows($conn));
    if( ubah($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil diubah');
            document.location.href='index.php'
        </script>
        ";
    }else  {
       echo "
        <script>
           alert('data gagal diubah');
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
<title>EDIT MENU | SI RESTORAN</title>
	<link rel="stylesheet" href="form.css">
</head>
<body>
<h2>EDIT DATA MENU</h2>
	<br/>
	<a href="menu.html"><button>KEMBALI</button></a>
	<br/>
    <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_menu" value="<?= $m["id_menu"]; ?>">
    <input type="hidden" name="gambarlama" value="<?= $m["image"]; ?>">

        <ul>
                <label for="kategori_menu">Kategori Menu :</label><br>
                <input type="text" name = "kategori_menu" id="kategori_menu" required value="<?= $m["kategori_menu"]; ?>" ><br>
            <br>
                <label for="nama_menu">Nama Menu   :</label><br>
                <input type="text" name = "nama_menu" id="nama_menu" required value="<?= $m["nama_menu"]; ?>"><br>
            <br>

                <label for="image"></label>
                <!-- <img src="img/<?= $m["image"]; ?>" width="40"> -->
                <input type="hidden" name = "image" id="image" required >
            <br>
                <label for="harga">Harga     :</label><br>
                <input type="text" name = "harga" id="harga" required value="<?= $m["harga"]; ?>"><br>
            
                <br><button type="submit" name="submit"> Change Menu </button>
        </ul>    
    </form>
    
</body>
</html>