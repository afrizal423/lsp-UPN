<?php
include 'config/db.php';
$db = new database();
$koneksi = $db->koneksi();
if ($koneksi -> connect_errno) {
    echo "Failed to connect to MySQL: " . $db->koneksi() -> connect_error;
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # code...
    $nama = mysqli_real_escape_string($koneksi,htmlentities($_POST['nama']));
    $username = mysqli_real_escape_string($koneksi,htmlentities($_POST['username']));
    $password = mysqli_real_escape_string($koneksi,htmlentities($_POST['password']));
    $confirm_password = mysqli_real_escape_string($koneksi,htmlentities($_POST['confirm_password']));
    $email = mysqli_real_escape_string($koneksi,htmlentities($_POST['email']));
    $ttl = mysqli_real_escape_string($koneksi,htmlentities($_POST['ttl']));
    $alamat = mysqli_real_escape_string($koneksi,htmlentities($_POST['alamat']));
    $no_hp = mysqli_real_escape_string($koneksi,htmlentities($_POST['no_hp']));
    $paypal_id = mysqli_real_escape_string($koneksi,htmlentities($_POST['paypal_id']));
    
    $gate = true;
    if($password != $confirm_password){
        echo '<script language="javascript">alert("Password Harus Sama !"); document.location=window.history.back();</script>';
        $gate=false;
    }
    // query untuk menambil akun pada tabel admin
    $query1 = mysqli_query($koneksi,"select * from admin where username_admin='$username' LIMIT 1");
    // query untuk menambil akun pada tabel client
    $query2 = mysqli_query($koneksi,"select * from client where username_client='$username' LIMIT 1");
    if(mysqli_num_rows($query1)!=0 || mysqli_num_rows($query2)!=0){
        echo '<script language="javascript">alert("Username Telah Terpakai !"); document.location=window.history.back();</script>';
        $gate=false;
    }
    // query untuk menambil akun pada tabel client email
    $query3 = mysqli_query($koneksi,"select * from client where email='$email' LIMIT 1");
    if(mysqli_num_rows($query3)!=0){
        echo '<script language="javascript">alert("email Telah Terpakai !"); document.location=window.history.back();</script>';
        $gate=false;
    }
    $md5 = md5($password); //hashmd5
    $pw = password_hash($md5, PASSWORD_BCRYPT);
    if ($gate == true) {
        # code...
        $hasil=mysqli_query($koneksi,"insert into client (`id_client`, `nama_client`, `username_client`, `password`, `email`, `ttl`, `gender`, `alamat`, `kota`, `no_hp`, `paypal_id`) values(NULL, '$nama','$username','$pw','$email','$ttl','','$alamat','','$no_hp','$paypal_id')");
    }
    // INSERT INTO `client` (`id_client`, `nama_client`, `username_client`, `password`, `email`, `ttl`, `gender`, `alamat`, `kota`, `no_hp`, `paypal_id`) VALUES (NULL, 'afrizal', 'afrizal', '$2y$10$uhW9G3veqmkJErfcNZuk8e6s3sd1tUA4wSipVIys9aZ7kb3Hc1IEe', 'ijal@ijal.com', '2020-10-14', 'L', 'sby', 'Sby', '0', '1');
    if ($hasil){
            echo '<script language="javascript">alert("Sukses mendaftar !"); document.location="/";</script>';
        } else {
            // echo("Error description: " . $koneksi -> error);
            echo '<script language="javascript">alert("Gagal mendaftar !"); document.location="/";</script>';
        }
}
?>