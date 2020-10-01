<?php
include '../../config/db.php';
$db = new database();
$koneksi = $db->koneksi();
$db->gateAdmin();
$id=$_POST['id_kat_barang'];
$data = mysqli_query($koneksi,"delete from kategori_barang where id_kat_barang='$id'");
echo json_encode($id);

?>