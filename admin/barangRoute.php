<?php
include 'barangClass.php';
$br = new Barang();
$aksi = $_GET['aksi'];

if ($aksi == "tambah") {
    # code...
    $data = array(
        'id_kat_barang' => $_POST['id_kat_barang'],
        'nama_barag' => $_POST['nama_barag'],
        'stok_barang' => $_POST['stok_barang'],
        'harga_barang' => $_POST['harga_barang'],
    );
    // $jumlahFile = $_FILES['foto']['name'];
    // echo json_encode($jumlahFile);
    $br->tmbhBarang($data);
}elseif($aksi == "hapus"){
    $br->delbarang($_GET['id']);
//    header("location:index.php");
}elseif($aksi == "update"){
    $data = array(
        'id_barang' => $_POST['id'],
        'id_kat_barang' => $_POST['id_kat_barang'],
        'nama_barag' => $_POST['nama_barag'],
        'stok_barang' => $_POST['stok_barang'],
        'harga_barang' => $_POST['harga_barang'],
        'foto_lama' => $_POST['old_foto'],
    );
    $br->update($data);
    // echo json_encode($data);
    // $db->update($_POST['id'],$_POST['nama'],$_POST['alamat'],$_POST['usia']);
    // header("location:index.php");
}

?>