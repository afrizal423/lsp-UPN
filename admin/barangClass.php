<?php 
include '../config/db.php';

class Barang extends database 
{
    function __construct(){
        $this->gateAdmin();
    }

    public function tampil_data()
    {
        # code...
        $query=mysqli_query($this->koneksi(),"SELECT * FROM barang");
        //$data=$mysqli->query($mysqli,$query);
        $hasil = array();
        while($d = mysqli_fetch_array($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }

    public function getKategori()
    {
        # code...
        $query=mysqli_query($this->koneksi(),"SELECT * FROM kategori_barang");
        //$data=$mysqli->query($mysqli,$query);
        $hasil = array();
        while($d = mysqli_fetch_array($query)){
            $hasil[] = $d;
        }
        return $hasil;
    }

    public function tmbhBarang($data)
    {
        // echo $data['nama_barang'];
        $limit = 10 * 1024 * 1024;
        $ekstensi =  array('png','jpg','jpeg','gif');
        $jumlahFile = count($_FILES['foto']['name']);
        // $data['foto_barang']
        for($x=0; $x<$jumlahFile; $x++){
            $namafile = $_FILES['foto']['name'][$x];
            $tmp = $_FILES['foto']['tmp_name'][$x];
            $tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
            $ukuran = $_FILES['foto']['size'][$x];	
            echo json_encode($tmp);
            if($ukuran > $limit){
                header("location:barang.php?alert=gagal_ukuran");		
            } else {
                if(!in_array($tipe_file, $ekstensi)){
                    header("location:barang.php?alert=gagal_ektensi");			
                }else{		
                    $string = str_replace(' ', '_', $namafile);
                    $x = date('dmY').'-'.$string;
                    move_uploaded_file($tmp, '../assets/img/'.$x);                    
                    // echo json_encode($data);
                    mysqli_query($this->koneksi(),"INSERT INTO barang VALUES(NULL, '".$data['id_kat_barang']."', '".$data['nama_barag']."',  '".$data['stok_barang']."',  '".$data['harga_barang']."',  '".$x."')");
                    header("location:barang.php?alert=simpan");
                }
            }
        }
    }

    public function delbarang($id)
    {
        # code...
        $data = mysqli_query($this->koneksi(),"select * from barang where id_barang='$id'");
        $hasil = mysqli_fetch_object($data);
        echo $hasil->foto_barang;
        unlink('../assets/img/'.$hasil->foto_barang);
        mysqli_query($this->koneksi(),"delete from barang where id_barang='$id'");
        header("location:barang.php");
    }

    public function getEdit($id)
    {
        # code...
        $data = mysqli_query($this->koneksi(),"select * from barang where id_barang='$id'");
        $hasil = mysqli_fetch_object($data);
        return $hasil;
    }

    public function update($dt)
    {
        # code...
        $cekfile = $_FILES['foto']['name'];
        // echo json_encode($dt['foto_lama']);
        if ($cekfile[0]!=null) {
            /**
             * Jika dia ada foto maka upload foto
             */
            $limit = 10 * 1024 * 1024;
            $ekstensi =  array('png','jpg','jpeg','gif');
            $jumlahFile = count($_FILES['foto']['name']);
            for($x=0; $x<$jumlahFile; $x++){
                $namafile = $_FILES['foto']['name'][$x];
                $tmp = $_FILES['foto']['tmp_name'][$x];
                $tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
                $ukuran = $_FILES['foto']['size'][$x];	
                // echo json_encode($tmp);
                if($ukuran > $limit){
                    header("location:barang.php?alert=gagal_ukuran");		
                } else {
                    if(!in_array($tipe_file, $ekstensi)){
                        header("location:barang.php?alert=gagal_ektensi");			
                    }else{		
                        $string = str_replace(' ', '_', $namafile);
                        $x = date('dmY').'-'.$string;
                        move_uploaded_file($tmp, '../assets/img/'.$x);
                        unlink('../assets/img/'.$dt['foto_lama']);
                        // ubah variable baru
                        $dt['foto_lama'] = $x;                
                        // echo json_encode($data);
                        // header("location:barang.php?alert=simpan");
                    }
                }
            }
        }
            /**
             * Jika kosong, maka akan tetap
             */
        // echo $dt['foto_lama'];
        mysqli_query($this->koneksi(),"update barang set nama_barag='".$dt['nama_barag']."', stok_barang='".$dt['stok_barang']."', harga_barang='".$dt['harga_barang']."', foto_barang='".$dt['foto_lama']."', id_kat_barang='".$dt['id_kat_barang']."'  where id_barang='".$dt['id_barang']."'");
       header("location:barang.php?alert=simpan");
    }
}

?>