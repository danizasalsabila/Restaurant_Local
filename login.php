<?php

session_start();
require 'functions.php';

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result= mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    //cek username
    if(mysqli_num_rows($result)===1){

        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            //set session
            $_SESSION["login"] = true;

            header("Location: home.html");
            exit;
        }
    }
    $error = true;
}

// require 'functions.php';

// if( isset($_POST["login"])){
//     $username = $_POST["username"];
//     $password = $_POST["password"];

//     $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

//     //cek username
//     if(mysqli_num_rows($result)===1){

//         //cek password
//         $row = mysqli_fetch_assoc($result);
//         if (password_verify($password, $row["password"])) {
//             header("Location: index.php");
//             exit;
//         }
//     }
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="stylesheetlogin.css"> -->
    <link rel="stylesheet" href="style-home.css">
    <title>LOGIN</title>
</head>
<div class="container2">
<body>
    <h4>login</h4>
    <?php if(isset($error)) : ?>
    <p style ="color:red; font-style:italic;">incorrect password or username</p>
    <?php endif; ?>
    <form action="" method="post">
    <ul>
        <label for="username">Username : </label><br>
        <input type="text" name="username" id="username"><br>
    <br>
        <label for="password">Password : </label><br>
        <input type="password" name="password" id="password"><br>
    <br>
        <button type="submit" name="login">log in </button>
        <br>
        <p> belum punya akun?
                  <a href="registrasi.php" class = "button">Sign up</a>
    </ul>
    
    
    </form>
</body>
</div>
</html>
