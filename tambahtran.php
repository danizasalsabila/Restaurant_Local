<?php

session_start();
if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require 'functions.php';

//cek apakah tobol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
    $id_transaksi = trim(mysqli_real_escape_string($conn,$_POST['id_transaksi']));
    $reservasi = trim(mysqli_real_escape_string($conn,$_POST['reservasi']));
    $user = trim(mysqli_real_escape_string($conn,$_POST['user']));
    $tanggal =  trim(mysqli_real_escape_string($conn,$_POST['tanggal']));
    $reserv = trim(mysqli_real_escape_string($conn,$_POST['reserv']));
    $customer =  trim(mysqli_real_escape_string($conn,$_POST['customer']));
    $menu = trim(mysqli_real_escape_string($conn,$_POST['menu']));
    $jumlah = trim(mysqli_real_escape_string($conn,$_POST['jumlah']));
    $total = trim(mysqli_real_escape_string($conn,$_POST['total']));
    // $konsumen = trim(mysqli_real_escape_string($conn,$_POST['konsumen']));
    // $pegawai = trim(mysqli_real_escape_string($conn,$_POST['pegawai']));
    // $produsen = trim(mysqli_real_escape_string($conn,$_POST['produsen']));



    mysqli_query($conn, "INSERT INTO transaksi(id_transaksi, id_reservasi, id_user, tanggal, no_pesanan, id_customer, id_menu, jumlah, total)
                        VALUES ('', '$reservasi', '$user', '$tanggal', '$reserv', '$customer',  '$menu', '$jumlah', '$total')
                     ") or die(mysqli_error($conn));

        // $obat = $_POST['obat'];
        // foreach ($obat as $row){
        //     mysqli_query($conn, "INSERT INTO obat(kode_obat)  VALUES ('', '$row')
        //  ") or die(mysqli_error($conn));
        // }

    echo "<script>  alert('data berhasil ditambahkan');
            document.location.href='transaksi.php' </script>";


        
    //untuk cek apakan data berhasil ditambahkan atau tidak
    //var_dump(mysqli_affected_rows($conn));\\


    // if( tambahfaktur_penjualan($_POST) > 0) {
    //     echo "
    //     <script>
    //         alert('data berhasil ditambahkan');
    //         document.location.href='fakturpenjualan.php'
    //     </script>
    //     ";
    // }else  {
    //    echo "
    //     <script>
    //        alert('data gagal ditambahkan');
    //        document.location.href='fakturpenjualan.php'
    //     </script>
    //    ";
    // }



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
   
<title>Laporan Penjualan | SI RESTORAN</title>
	<link rel="stylesheet" href="form.css">

</head>
<body>
    <h2>Tambah Transaksi</h2><br>
<a href="transaksi.php"><button>KEMBALI</button></a>


<form action="" method="post"  >
    <ul>
            <label type = "hidden" for="id_transaksi">  </label><br>
            <input type = "hidden" name="id_transaksi" id="id_transaksi" class="form-control" required>

        <!-- NAMA OBAT -->
        <label for="reservasi">Meja reservasi : </label><br>
        <select name="reservasi" style="width: 300px;"  id="reservasi" class="form-control" required><br>
            <br><option  style="width: 30px;"  value="" size="10px">-pilih-</option> <bsr>
            <?php 
                $sql_reservasi = mysqli_query($conn, "SELECT * FROM reservasi") or die
                (mysqli_error($conn));

                while($data_reservasi = mysqli_fetch_assoc($sql_reservasi)) {
                    echo '<option value="'.$data_reservasi['id_reservasi'].'">
                    '.$data_reservasi['no_meja'].'
                    </option>';
                }
            ?>
        </select>
        <br>
                <br>
        

        <!-- JENIS OBAT -->
        <label for="user"> Pegawai : </label>  <br>          
        <select name="user" style="width: 300px;"  id="user" class="form-control" required><br>
             <option value="">-pilih-</option> <br>
                <?php 
                $sql_user = mysqli_query($conn, "SELECT * FROM user") or die
                (mysqli_error($conn));

                while($data_user = mysqli_fetch_assoc($sql_user)) {
                    echo '<option value="'.$data_user['id_user'].'">
                    '.$data_user['username'].'
                    </option>';
                }
            ?>
        </select>
        
<br>
        <br>
            <label style="width: 300px;"   for="tanggal"> Tanggal Pembelian : </label><br>
            <input style="width: 300px;" type = "date" name="tanggal" id="tanggal" value="<?=date('Y-m-d')?>" class="form-control" required><br>
            
        <br>


                <br>
        <!-- TABEL HARGA  -->
        <label for="reserv"> Nomor Pesanan : </label><br>
        <select name="reserv" style="width: 300px;"  id="reserv" class="form-control" required><br>
            <option value="">-pilih-</option> <br>
            <?php 
                $sql_reserv = mysqli_query($conn, "SELECT * FROM customer") or die
                (mysqli_error($conn));

                while($data_reserv = mysqli_fetch_assoc($sql_reserv)) {
                    echo '<option value="'.$data_reserv['no_pesanan'].'">
                    '.$data_reserv['no_pesanan'].'
                    </option>';
                }
            ?>
        </select>
        <br>
<br>
        
        <!-- TABEL KONSUMEN  -->
        <label for="customer"> Nama customer : </label> <br>
        <select name="customer" style="width: 300px;"  id="customer" class="form-control" required><br>
            <option value="">-pilih-</option> <br>
            <?php 
                $sql_customer = mysqli_query($conn, "SELECT * FROM customer") or die
                (mysqli_error($conn));

                while($data_customer = mysqli_fetch_assoc($sql_customer)) {
                    echo '<option value="'.$data_customer['id_customer'].'">
                    '.$data_customer['nama_customer'].'
                    </option>';
                }
            ?>
        </select>
        <br>

        <br>
        <!-- TABEL KONSUMEN  -->
        <label for="menu"> Nama menu : </label> <br>
        <select name="menu" style="width: 300px;"  id="menu" class="form-control" required><br>
            <option value="">-pilih-</option> <br>
            <?php 
                $sql_menu = mysqli_query($conn, "SELECT * FROM menu") or die
                (mysqli_error($conn));

                while($data_menu = mysqli_fetch_assoc($sql_menu)) {
                    echo '<option value="'.$data_menu['id_menu'].'">
                    '.$data_menu['nama_menu'].'
                    </option>';
                }
            ?>
        </select><br>
        

        
        <br>
            <label style="width: 300px;"  for="jumlah"> Jumlah Pesanan : </label><br>
            <input style="width: 300px;"  type = "text" style="width: 300px;"  name="jumlah" id="quantity_jual" class="form-control" required><br>
        
        <br>
            <label style="width: 300px;"  for="total"> Total Transaksi : </label><br>
            <input style="width: 300px;"  type = "text" name="total" id="jumlah_pembayaran" class="form-control" required><br>
        
        <br><br>


        <br>
            <button type="submit"  class="button" name="submit" >tambah data</button><br>
</form>
</body>
</html>