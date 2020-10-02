<?php
include 'config/db.php';

class indexClass extends database
{
    public function indexAwal()
    {
        $query=mysqli_query($this->koneksi(),"SELECT * FROM barang");
        $hasil = array();
        while($d = mysqli_fetch_array($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }
    function rupiah($angka){
	
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }
    public function lihatBarang($id)
    {
        # code...
        $id=$this->decode($id);
        $data = mysqli_query($this->koneksi(),"select * from barang where id_barang='$id'");
        $hasil = mysqli_fetch_object($data);
        return $hasil;
    }
    
}


?>