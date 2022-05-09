<?php


session_start();
if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require 'functions.php';


//ambil data diurl
$id_reservasi=$_GET["id_reservasi"];

//query data reservasi berdasarkan id_reservasi
$m = query("SELECT * FROM reservasi WHERE id_reservasi = $id_reservasi")[0];

//cek apakah tobol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
    
    //untuk cek apakan data berhasil diubahkan atau tidak
    //var_dump(mysqli_affected_rows($conn));
    if( ubahres($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil diubah');
            document.location.href='reservasi.php'
        </script>
        ";
    }else  {
       echo "
        <script>
           alert('data gagal diubah');
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
<title>EDIT RESERVASI | SI RESTORAN</title>
	<link rel="stylesheet" href="form.css">
</head>
<body>
<h1>Ubah reservasi</h1> <br>
<a href="reservasi.php"><button>KEMBALI</button></a>

    <form action="" method="post">
    <input type="hidden" name="id_reservasi" value="<?= $m["id_reservasi"]; ?>">
        <ul>
                <label for="no_meja">no_meja     :</label><br>
                <input style="width: 300px;"  type="text" name = "no_meja" id="no_meja" required value="<?= $m["no_meja"]; ?>"><br>
            <br>
                <br><button type="submit" class="button" name="submit"> edit reservasi </button>
        </ul>    
    </form>
    
</body>
</html>