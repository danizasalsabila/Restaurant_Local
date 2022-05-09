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
    if( tambahres($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil ditambahkan');
            document.location.href='reservasi.php'
        </script>
        ";
    }else  {
       echo "
        <script>
           alert('data gagal ditambahkan');
           document.location.href='reservasi.php'
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
<title>Tambah Reservasi | SI RESTORAN</title>
	<link rel="stylesheet" href="form.css">
</head>
<body>
<h1>Tambah Reservasi</h1>
<a href="reservasi.php"><button>KEMBALI</button></a>

    <form action="" method="post">
        <ul>
                <label for="no_meja">no_meja   :</label><br>
                <input style="width: 300px;"  type="text" name = "no_meja" id="no_meja" required><br>
            <br>
            <br>
                <button type="submit" class="button" name="submit"> Add Menu </button>
            </li>
        </ul>    
    </form>
    
</body>
</html>