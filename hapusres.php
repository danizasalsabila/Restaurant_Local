<?php

require 'functions.php';

$id_reservasi=$_GET["id_reservasi"];

if( hapusres($id_reservasi) > 0) {
    // var_dump(mysqli_affected_rows($conn));
    // {
    //      if( mysqli_affected_rows($conn) > 0) {
    //     echo "data berhasil masuk";
    // }else  {
    //     echo "data gagal masuk";
    //     echo "<br>";
    //     echo mysqli_error($conn);
    // }
    echo "
        <script>
            alert('data berhasil dihapuskan');
            document.location.href='reservasi.php'
        </script>
        ";
    }else  {
       echo "
        <script>
           alert('data gagal dihapuskan');
           document.location.href='reservasi.php'
        </script>
       ";
}



?>