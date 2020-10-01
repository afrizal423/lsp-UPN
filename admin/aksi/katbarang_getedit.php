<?php
include '../../config/db.php';
$db = new database();
$koneksi = $db->koneksi();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    $data = mysqli_query($koneksi,"select * from kategori_barang where id_kat_barang='$id'");
    while($d = mysqli_fetch_array($data)){
        echo json_encode($d);
    }
} else {
    
    if ($_POST['update'] == true) {
        # code...
        $nm=$_POST['nama_kategori'];
        $id=$_POST['id_kat_barang'];
        mysqli_query($koneksi,"update kategori_barang set nama_kategori='$nm' where id_kat_barang='$id'");
        echo json_encode("sukses");
    }
   

}
?>