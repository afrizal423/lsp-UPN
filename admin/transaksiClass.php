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
        $query=mysqli_query($this->koneksi(),"SELECT * FROM transaksi inner join client using(id_client) where transaksi.status_kirim = 0 and transaksi.batal_beli = 0");
        //$data=$mysqli->query($mysqli,$query);
        $hasil = array();
        while($d = mysqli_fetch_array($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }
    public function history()
    {
        $query=mysqli_query($this->koneksi(),"SELECT * FROM transaksi inner join client using(id_client) where transaksi.status_kirim = 1 or transaksi.batal_beli = 1");
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
        include "../config/coded.php";
        $coded = new Coded();
        $key = 'afrizal muhammad yasin';
        mysqli_query($this->koneksi(),"update transaksi set status_kirim='".$dt['status_kirim']."' where id_transaksi='".$dt['id_transaksi']."' ");
        $data = mysqli_query($this->koneksi(),"select * from transaksi where id_transaksi='".$dt['id_transaksi']."' inner join client using(id_client) order by transaksi.tanggal_transact DESC limit 1");
        $trans = mysqli_fetch_object($data);
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
         // Create email headers
        $from = 'AfrizalMY <no-reply@afrizalmy.com>';
        $headers .= 'From: '.$from."\r\n".
             'Reply-To: '.$from."\r\n" .
             'X-Mailer: PHP/' . phpversion();
        $td = '<p>Halo ,</p>
         <p>Terima kasih telah berbelanja di OSS LSP.<br />Barang pesanan anda sudah kami kirimkan sesuai alamat pada akun anda.<br />Untuk mendapatkan laporan/nota, silahkan kunjungi <a href="https://lsp.zalabs.my.id/printpdf.php?id="'.$coded->encrypt($dt['id_transaksi'],$key).'"" target="_blank">link ini</a>.</p>
         <p>Best regard,<br />Admin OSS LSP</p>';
             // Compose a simple HTML email message
        $message = '<html><body>';
         // $message .= '<h1><b>INI PERCOBAAN</b></h1>';
        $message .= $td;
        $message .= '</body></html>';
        
        $to = $trans->email;
        $subject = "Status pengiriman barang dari belanjaan ".$trans->nama_client."";
        mail($to, $subject, $message, $headers);
    }
    
}

?>