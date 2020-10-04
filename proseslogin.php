<?php
include 'config/db.php';
$db = new database();
// echo $db->koneksi();
if ($db->koneksi()-> connect_errno) {
    echo "Failed to connect to MySQL: " . $db->koneksi() -> connect_error;
    exit();
  }
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # code...
    // $mysqli=mysqli_connect("$this->hosts","$this->user","$this->password","$this->db");
    session_start();
    // escape string dan htmlentities, cara untuk menanggulangi dan mempersempit serangan SQL Injection
    // menangkap data dari form login
    $username = mysqli_real_escape_string($db->koneksi(),htmlentities($_POST['username']));
    // kita enkripsi awal menggunakan md5
    $password = mysqli_real_escape_string($db->koneksi(),htmlentities(md5($_POST['password'])));
    // query untuk menambil akun pada tabel user
    $query = mysqli_query($db->koneksi(),"select * from admin where username_admin='$username' LIMIT 1");
    // cek apakah query diatas ada yang error, maka akan menampilkan error pada layar
    if (!$query)
    echo(mysqli_error($db->koneksi()));
    //kita ambil data passwordnya yang terenkripsi password_bcrypt untuk dicocokkan dengan enkripsi md5 password
    $datanya = mysqli_fetch_array($query);
    $bcrypt =  $datanya['password_admin'];
    // dari variable query akan dicek berupa boolean, yang dimana 0 false dan 1 true
    // echo $bcrypt;
    if(mysqli_num_rows($query)==0){
            $query = mysqli_query($db->koneksi(),"select * from client where username_client='$username' LIMIT 1");
            $datanya = mysqli_fetch_array($query);
            $bcrypt =  $datanya['password'];
            if (mysqli_num_rows($query)==0 || mysqli_num_rows($query) > 1) {
                echo '<script language="javascript">alert("Tidak bisa Login !"); document.location="/";</script>';
            } else {
                if (password_verify($password, $bcrypt)) {
                    # code...
                    // jika true maka akan membuat session untuk username yang diinputkan login,
                    $_SESSION['nama']=$datanya['nama_client'];
                    $_SESSION['client']=$username;
                    // deklarasikan status diberi login untuk dicek nanti apakah true or false
                    $_SESSION['status'] = "login";
                    $_SESSION['level'] = "client";
                    // akan memunculkan alert
                    echo '<script language="javascript">alert("Anda berhasil Login !"); document.location="/";</script>';
                } else {
                    # code...
                    echo '<script language="javascript">alert("Tidak bisa Login !"); document.location="/";</script>';
                }
                
            }
            // Jika false maka akan muncul alert
            echo '<script language="javascript">alert("Tidak bisa Login !"); document.location="/";</script>';
    } else {
        //kita cek apakah sama atau tidak menurut password_verify()
        if (password_verify($password, $bcrypt)){
            // jika true maka akan membuat session untuk username yang diinputkan login,
            $_SESSION['admin']=$username;
            // deklarasikan status diberi login untuk dicek nanti apakah true or false
            $_SESSION['status'] = "login";
            $_SESSION['level'] = "admin";
            // akan memunculkan alert
            echo '<script language="javascript">alert("Anda berhasil Login !"); document.location="admin/index.php";</script>';
        } else {
            echo '<script language="javascript">alert("Tidak bisa Login !"); document.location="/";</script>';
        }
    }
}
?>