<?php

require 'functions.php';

 if(isset($_POST["register"])) {
     if(register($_POST) > 0) {
         echo "<script>
                alert('user berhasil ditambahkan');
                </script>";
                header("Location: user.php");
                exit;
     }else{
         echo mysqli_error($conn);
     }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style-home.css">
    <title>REGISTRASI</title>
    
</head>
<body>
<a  href="user.php" class ="button"> back to pegawai </a><br>


<div class="container2">

    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
    <ul>
        <label for="username">username : </label><br>
        <input type="text" name="username" id="username"><br>
    <br>
        <label for="password">password : </label><br>
        <input type="password" name="password" id="password"><br>
    <br>
        <label for="password2">confirm password : </label><br>
        <input type="password" name="password2" id="password2"><br>
    <br>
    <br>
        <label for="jabatan">jabatan : </label><br>
        <input type="jabatan" name="jabatan" id="jabatan"><br>
    <br>
    
        <button type="submit" name="register">sign up </button>
        <p> Sudah punya akun?
                  <a href="login.php" class = "button">Login</a>
    </ul>
    
    </form>
</body>
</html>