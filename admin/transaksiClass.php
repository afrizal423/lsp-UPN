<?php
include '../config/db.php';
class transaksi extends database
{
    function __construct(){
        $this->gateAdmin();
    }
    function rupiah($angka){
	
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }
    public function tampil_data()
    {
        $query=mysqli_query($this->koneksi(),"SELECT * FROM transaksi inner join client using(id_client) where transaksi.status_kirim = 0");
        //$data=$mysqli->query($mysqli,$query);
        $hasil = array();
        while($d = mysqli_fetch_array($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }
    public function history()
    {
        $query=mysqli_query($this->koneksi(),"SELECT * FROM transaksi inner join client using(id_client) where transaksi.status_kirim = 1");
        //$data=$mysqli->query($mysqli,$query);
        $hasil = array();
        while($d = mysqli_fetch_array($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }
    public function listbelanjaan($id)
    {
        $query=mysqli_query($this->koneksi(),"SELECT * FROM detail_transaksi inner join transaksi using(id_transaksi) inner join barang using(id_barang) inner join client using(id_client) where detail_transaksi.id_transaksi = $id");
        //$data=$mysqli->query($mysqli,$query);
        $hasil = array();
        while($d = mysqli_fetch_array($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }
    public function updatekirim($dt)
    {
        # code...
        mysqli_query($this->koneksi(),"update transaksi set status_kirim='".$dt['status_kirim']."' where id_transaksi='".$dt['id_transaksi']."' ");
    }
    
}

?>