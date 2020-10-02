<?php
  class database{
    protected $hosts="localhost";
    protected $user="root";
    protected $password="";
    protected $db="lsp";


    function __construct(){
      $mysqli=mysqli_connect("$this->hosts","$this->user","$this->password","$this->db");
      if(mysqli_connect_errno()) {
      echo "Gak iso konek!";
      exit;
      }
    }

    function koneksi(){
        $mysqli=mysqli_connect("$this->hosts","$this->user","$this->password","$this->db");
        return $mysqli;
    }

    public function gateAdmin()
    {
      // memulai session
        session_start();
        // cek apakah session yang dibuat tadi true untuk status berisikan login
        if($_SESSION['status']!="login" && $_SESSION['level']!="admin"){
          // jika true maka akan menampilkan alert
          echo '<script language="javascript">alert("Anda harus Login!"); document.location="/login";</script>';
        }
    }

    function encode($data) {
      return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
       
    function decode($data) {
      return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

  }


 ?>