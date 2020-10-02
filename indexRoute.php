<?php
include 'indexClass.php';
$br = new indexClass();
$aksi = $br->decode($_GET['aksi']);

if ($aksi == "tambahcart") {
//    echo $br->decode($_GET['barang']);
   $obj = $br->lihatBarang($_GET['barang']);
//    echo json_encode($obj);
    $br->tmbhcart($obj);
}elseif($aksi == "hapuscart"){
    $ps = $br->decode($_GET['posisi']);
    $br->delcart($ps);
    
//    header("location:index.php");
}elseif($aksi == "updatecart"){
    
}elseif($aksi == "deletecart"){
    session_start();
    unset($_SESSION['cart']);
    header("location:index.php");
}elseif($aksi == "checkout"){
    $br->checkout($_POST);
}

?>