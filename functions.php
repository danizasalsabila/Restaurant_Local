<?php

//koneksi kedatabase
$conn = mysqli_connect("localhost","root", "","sirestoran");


function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}


function tambah($data) {
    global $conn;
    //ambil data dari tiap elemen tiap form 
    $kategori_menu = htmlspecialchars($data["kategori_menu"]);
    $nama_menu = htmlspecialchars($data["nama_menu"]);
    $image = htmlspecialchars($data["image"]);
    $harga = htmlspecialchars($data["harga"]);

    // //upload gambar
    // $image = upload();
    // if( !$image ){
    //     return false;
    // }

    //panggil fungsi querynya
    $query = "INSERT INTO menu
                VALUES 
                ('', '$kategori_menu', '$nama_menu', '$image', '$harga' )
                ";
    
    mysqli_query($conn, $query); 
        return mysqli_affected_rows($conn);
}

function upload(){
    $namafile = $_FILES['image']['name'];
    $ukuranfile = $_FILES['image']['size'];
    $error = $_FILES['image'] ['error'];
    $tmpname = $_FILES['image']['tmp_name'];

    //cek apakah tidak ada file
    if($error ===4 ){
        echo "<script> alert('pilih gambar terlebih dahulu'); </script>";
        return false;
    }


    //cek apakah yang diupload gambar atau tidak
    $ekstensigambarvalid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if( !in_array($ekstensigambar, $ekstensigambarvalid)){
        echo "<script> alert('yang anda upload bukan gambar'); </script>";   
        return false;
    }

    //cek jika ukuran terlalu besar 
    if($ukuranfile > 1000000){
        echo "<script> alert('ukuran gambar terlalu besar'); </script>";
        return false;
    }

    //generate nama gambar baru
    $namafilebaru = uniqid(); 
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    //gambar siap diupload
    move_uploaded_file($tmpname, 'img/' . $namafilebaru);

    return $namafilebaru; 




}


function hapus($id_menu){
    global $conn;
    mysqli_query($conn, "DELETE FROM menu WHERE id_menu = $id_menu");
    return mysqli_affected_rows($conn);
}



function hapususer($id_user){
    global $conn;
    mysqli_query($conn, "DELETE FROM user WHERE id_user = $id_user");
    return mysqli_affected_rows($conn);
}

function hapustrans($id_transaksi){
    global $conn;
    mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi = $id_transaksi");
    return mysqli_affected_rows($conn);
}


function ubah($data) {
    global $conn;
    //ambil data dari tiap elemen tiap form 
    $id_menu = ($data["id_menu"]);
    $kategori_menu = htmlspecialchars($data["kategori_menu"]);
    $nama_menu = htmlspecialchars($data["nama_menu"]);
    $image = htmlspecialchars($data["image"]);

    $harga = htmlspecialchars($data["harga"]);
    // $gambarlama = htmlspecialchars($data["gambarlama"]);

    // //cek apakah user pilih gambar baru atau tidak
    // if($_FILES['image']['error'] === 4){
    //     $image = $gambarlama;
    // }else {
    //     $image = upload();

    // }



    //panggil fungsi querynya
    $query = "UPDATE menu 
                SET 
                id_menu = $id_menu,
                kategori_menu = '$kategori_menu',
                nama_menu = '$nama_menu',
                image = '$image',
                harga = $harga

                WHERE id_menu = $id_menu
                ";
    
    mysqli_query($conn, $query); 
        return mysqli_affected_rows($conn);
}


function search($keyword) {
    $query = "SELECT * FROM menu 
              WHERE
              kategori_menu LIKE '%$keyword%' OR 
              nama_menu LIKE '%$keyword%'
              ";
    return query($query);
  }


function register($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $jabatan = $data["jabatan"];

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username='$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
        alert('username already exists');
        </script>";
        return false;
    }

    //cek konfrimasi password
    if( $password !== $password2) {
        echo "<script>
        alert('wrong password');
        </script>";
        return false;
    }
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan password baru kedatabase
    mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password','$jabatan')");

    return mysqli_affected_rows($conn);

}

//CUSTOMER

function tambahcust($data) {
    global $conn;
    //ambil data dari tiap elemen tiap form 
    $nama_customer = htmlspecialchars($data["nama_customer"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $no_pesanan = htmlspecialchars($data["no_pesanan"]);
   

    //panggil fungsi querynya
    $query = "INSERT INTO customer
                VALUES 
                ('', '$nama_customer', '$no_hp', '$no_pesanan')
                ";
    
    mysqli_query($conn, $query); 
        return mysqli_affected_rows($conn);
}



function ubahuser($data) {
    global $conn;
    //ambil data dari tiap elemen tiap form 
    $id_user = ($data["id_user"]);
    $username = htmlspecialchars($data["username"]);
    $jabatan = htmlspecialchars($data["jabatan"]);
    // $no_pesanan = htmlspecialchars($data["no_pesanan"]);

    //panggil fungsi querynya
    $query = "UPDATE user 
                SET 
                -- id_user = $id_user,
                username = '$username',
                jabatan = '$jabatan'
                WHERE id_user = $id_user
                ";
    
    mysqli_query($conn, $query); 
        return mysqli_affected_rows($conn);
}


function ubahcust($data) {
    global $conn;
    //ambil data dari tiap elemen tiap form 
    $id_customer = ($data["id_customer"]);
    $nama_customer = htmlspecialchars($data["nama_customer"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $no_pesanan = htmlspecialchars($data["no_pesanan"]);

    //panggil fungsi querynya
    $query = "UPDATE customer 
                SET 
                id_customer = $id_customer,
                nama_customer = '$nama_customer',
                no_hp = '$no_hp',
                no_pesanan = $no_pesanan

                WHERE id_customer = $id_customer
                ";
    
    mysqli_query($conn, $query); 
        return mysqli_affected_rows($conn);
}


function hapuscust($id_customer){
    global $conn;
    mysqli_query($conn, "DELETE FROM customer WHERE id_customer = $id_customer");
    return mysqli_affected_rows($conn);
}


function searchcust($keyword) {
    $query = "SELECT * FROM customer 
              WHERE
              nama_customer LIKE '%$keyword%' OR 
              no_pesanan LIKE '%$keyword%'
              ";
    return query($query);
  }



  function searchuser($keyword) {
    $query = "SELECT * FROM user
              WHERE
              username LIKE '%$keyword%' OR 
              jabatan LIKE '%$keyword%'
              ";
    return query($query);
  }

  
function searchres($keyword) {
    $query = "SELECT * FROM reservasi 
              WHERE
              no_meja LIKE '%$keyword%'
              ";
    return query($query);
  }

  


//RESERVASI


function ubahres($data) {
    global $conn;
    //ambil data dari tiap elemen tiap form 
    $id_reservasi = ($data["id_reservasi"]);
    $no_meja = htmlspecialchars($data["no_meja"]);

    //panggil fungsi querynya
    $query = "UPDATE reservasi 
                SET 
                id_reservasi = $id_reservasi,
                no_meja = $no_meja

                WHERE id_reservasi = $id_reservasi
                ";
    
    mysqli_query($conn, $query); 
        return mysqli_affected_rows($conn);
}


function tambahres($data) {
    global $conn;
    //ambil data dari tiap elemen tiap form 
    $no_meja = htmlspecialchars($data["no_meja"]);
   

    //panggil fungsi querynya
    $query = "INSERT INTO reservasi
                VALUES 
                ('', '$no_meja')
                ";
    
    mysqli_query($conn, $query); 
        return mysqli_affected_rows($conn);
}


function hapusres($id_reservasi){
    global $conn;
    mysqli_query($conn, "DELETE FROM reservasi WHERE id_reservasi = $id_reservasi");
    return mysqli_affected_rows($conn);
}



function searchtransaksi($keyword) {
    $query = "SELECT * FROM transaksi         
                INNER JOIN reservasi ON transaksi.id_reservasi = reservasi.id_reservasi
                INNER JOIN user ON transaksi.id_user = user.id_user
                INNER JOIN customer ON transaksi.no_pesanan = customer.no_pesanan
                INNER JOIN menu ON transaksi.id_menu = menu.id_menu
              WHERE
              username LIKE '%$keyword%' OR 
              tanggal LIKE '%$keyword%' OR
              nama_customer LIKE '%$keyword%' OR
              nama_menu LIKE '%$keyword%' 

              ";
    return query($query);
  }


// function login($data){
//     global $conn;

//     $username = strtolower(stripslashes($data["username"]));
//     $password = mysqli_real_escape_string($conn, $data["password"]);

//     if($password !== $password) {
//         echo "
//         <script> alert('incorrect password');
//         </script>";
//         return false;
//     }
// }


?>