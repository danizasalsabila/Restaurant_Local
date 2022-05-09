<?php


session_start();
if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require 'functions.php';


//ambil data diurl
$id_user=$_GET["id_user"];

//query data user berdasarkan id_user
$m = query("SELECT * FROM user WHERE id_user = $id_user")[0];

//cek apakah tobol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
    
    //untuk cek apakan data berhasil diubahkan atau tidak
    //var_dump(mysqli_affected_rows($conn));
    if( ubahuser($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil diubah');
            document.location.href='user.php'
        </script>
        ";
    }else  {
       echo "
        <script>
           alert('data gagal diubah');
           document.location.href='user.php'
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
<title>EDIT USER | SI RESTORAN</title>
	<link rel="stylesheet" href="form.css">
</head>
<body>
<h2>EDIT DATA USER</h2>
	<br/>
	<a href="user.html"><button>KEMBALI</button></a>
	<br/>
    <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_user" value="<?= $m["id_user"]; ?>">
    <input type="hidden" name="gambarlama" value="<?= $m["image"]; ?>">

        <ul>
                <label for="username">Nama User Pegawai :</label><br>
                <input type="text" name = "username" id="username" required value="<?= $m["username"]; ?>" ><br>
            <br>
                <label for="password"></label>
                <input type="hidden" name = "password" id="password" required value="<?= $m["password"]; ?>"><br>
            <br>
                <label for="jabatan">jabatan :</label><br>
                <input type="text" name = "jabatan" id="jabatan" required value="<?= $m["jabatan"]; ?>"><br>
            
                <br><button type="submit" name="submit"> Change User </button>
        </ul>    
    </form>
    
</body>
</html>