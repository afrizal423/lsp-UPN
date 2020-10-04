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
    public function listkategori()
    {
        # code...
        $query=mysqli_query($this->koneksi(),"SELECT * FROM kategori_barang");
        $hasil = array();
        while($d = mysqli_fetch_array($query)){
            $hasil[] = $d;
        }
        return $hasil;

    }
    public function lihatkategori($id)
    {
        $query=mysqli_query($this->koneksi(),"SELECT * FROM barang where id_kat_barang='$id'");
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
    public function tmbhcart($obj)
    {   
        session_start();
        // $cart = array();
        $cart = unserialize(serialize($_SESSION['cart'])); // set $cart as an array, unserialize() converts a string into array
        // echo json_encode($obj);
        $datanya = array(
            'id_barang' => $obj->id_barang,
            'id_kat_barang' => $obj->id_kat_barang,
            'nama_barag' => $obj->nama_barag,
            'stok_barang' => $obj->stok_barang,
            'harga_barang' => $obj->harga_barang,
            'jumlah_barang' => 1
        );
        $_SESSION['cart'][] = $datanya; // $_SESSION['cart']: set $cart as session variable
        header("location:cart.php");
        // unset($_SESSION['cart']);
        // echo json_encode($cart);
        # code...
    }
    public function delcart($posisi)
    {
        session_start();
        $cart = unserialize(serialize($_SESSION['cart']));
        // echo json_encode($cart[$posisi]);
		unset($cart[$posisi]);
		$cart = array_values($cart);
		$_SESSION['cart'] = $cart;
        header('Location: cart.php');
        
    }
    public function checkout($dt)
    {
        session_start();
        $usr = $_SESSION['client'];
        $data = mysqli_query($this->koneksi(),"select * from client where username_client='$usr'");
        $usr = mysqli_fetch_object($data);
        // echo json_encode($usr->id_client);
        // buat data transaksi
        mysqli_query($this->koneksi(),"insert into transaksi(id_client, cara_bayar, tanggal_transact, feedback) values('$usr->id_client','".$dt['cara_bayar']."','".date("Y-m-d H:i:s")."','".$dt['feedback']."') ");
        $data = mysqli_query($this->koneksi(),"select * from transaksi where id_client='$usr->id_client' order by tanggal_transact DESC limit 1");
        $trans = mysqli_fetch_object($data);
        // echo json_encode($trans->id_transaksi);
        // echo json_encode($dt);
        //kita beralih ke cart
        $cart = unserialize(serialize($_SESSION['cart']));$index=0;
        for($i=0; $i<count($cart);$i++) {
            echo $cart[$i]['nama_barag'];
            mysqli_query($this->koneksi(),"insert into detail_transaksi values(NULL,'".$trans->id_transaksi."','".$cart[$i]['id_barang']."','".$cart[$i]['jumlah_barang']."','".$cart[$i]['jumlah_barang'] * $cart[$i]['harga_barang']."')");
        }
        # kita hapus session cartnya
        unset($_SESSION['cart']);

        /**
         * Kirim email disini pdfnya, besok sabtu/minggu
         */

        
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Create email headers
        $from = 'krs@bosku.com';
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $td = '<p>Halo ,</p>
        <p>Terima kasih telah berbelanja di OSS LSP.<br />Silahkan lihat menu <a href="https://lsp.zalabs.my.id/history.php">history belanja</a>, untuk memastikan belanjaan anda sudah terkirim <br />maupun anda bisa membatalkan pesanan jika barang tersebut belum terkirim oleh kami.</p>
        <p>Best regard,<br />Admin OSS LSP</p>';
            // Compose a simple HTML email message
        $message = '<html><body>';
        // $message .= '<h1><b>INI PERCOBAAN</b></h1>';
        $message .= $td;
        $message .= '</body></html>';

        $to = $usr->email;
        $subject = "Pembelian barang dari '".$usr->nama_client."'";
        mail($to, $subject, $message, $headers);

        header("location:index.php");
    }

    public function listbelanjaan($id)
    {
        $data = mysqli_query($this->koneksi(),"select * from client where username_client='$id'");
        $usr = mysqli_fetch_object($data);
        $query=mysqli_query($this->koneksi(),"SELECT * FROM transaksi where id_client = $usr->id_client");
        //$data=$mysqli->query($mysqli,$query);
        $hasil = array();
        while($d = mysqli_fetch_array($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }
    public function listbelanjaanpdf($id)
    {
        $query=mysqli_query($this->koneksi(),"SELECT * FROM detail_transaksi inner join transaksi using(id_transaksi) inner join barang using(id_barang) inner join client using(id_client) where detail_transaksi.id_transaksi = $id");
        //$data=$mysqli->query($mysqli,$query);
        $hasil = array();
        while($d = mysqli_fetch_array($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }
    public function showbelanjaan($id)
    {
        $query=mysqli_query($this->koneksi(),"SELECT * FROM detail_transaksi inner join transaksi using(id_transaksi) inner join barang using(id_barang) inner join client using(id_client) where detail_transaksi.id_transaksi = $id");
        //$data=$mysqli->query($mysqli,$query);
        $hasil = array();
        while($d = mysqli_fetch_array($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }
}


?>