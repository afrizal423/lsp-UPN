<?php
include 'indexClass.php';
$br = new indexClass();
$aksi = $br->decode($_GET['aksi']);

if ($aksi == "tambahcart") {
   echo $br->decode($_GET['barang']);
}elseif($aksi == "hapuscart"){
    
//    header("location:index.php");
}elseif($aksi == "updatecart"){
    
}elseif($aksi == "deletecart"){
    
}

?>