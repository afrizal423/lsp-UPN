<?php
include 'indexClass.php';
include 'config/coded.php';
$idx = new indexClass();
$coded = new Coded();
$koneksi = $idx->koneksi();
$key = 'afrizal muhammad yasin';
session_start();
if (!isset($_SESSION['status']) && $_SESSION['status']!='login' && $_SESSION['level'] != 'client') {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>OSS - LSP</title>

        <!-- Bootstrap core CSS -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="assets/css/shop-homepage.css" rel="stylesheet">
        <script src="assets/ckeditor/ckeditor.js"></script>

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
            integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
            crossorigin="anonymous"/>

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">OSS LSP</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarResponsive"
                    aria-controls="navbarResponsive"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <?php
                        if (!isset($_SESSION['status'])) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                        <?php } ?>
                        <?php
                        if (isset($_SESSION['status']) && $_SESSION['status']=='login' && $_SESSION['level'] == 'client') {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="history.php">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                History Belanja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Cart</a>
                        </li>
                        <?php } ?>
                        <?php
                        if (isset($_SESSION['status']) && $_SESSION['status']=='login') {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <div class="col-lg-3">

                    <h1 class="my-4">OSS LSP</h1>
                    <div class="list-group">
                        <small>Kategori :</small>
                        <?php 
        $no = 1;
        foreach($idx->listkategori() as $x){
        ?>
                        <a
                            href="index.php?kategori=<?php echo $coded->encrypt($x['id_kat_barang'],$key) ?>"
                            class="list-group-item"><?php echo $x['nama_kategori'];?></a>
                        <?php } ?>
                    </div>

                </div>
                <!-- /.col-lg-3 -->

                <!-- isi konten disini -->
                <div class="card col-lg-9">
                    <div class=" my-4">
                        <h5>History Belanja</h5>
                        <!-- tambah kategori -->
                        <!-- <a href="historytransaksi.php" class="btn btn-primary float-right">History
                        Transaksi</a> -->

                        <table class="table table-responsive table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Cara Bayar</th>
                                    <th scope="col">Status Kirim</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            $no = 1;
                            // echo json_encode($idx->listbelanjaan($_SESSION['client']));
                            foreach($idx->listbelanjaan($_SESSION['client']) as $x){
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++; ?></th>
                                    <td><?php echo $x['tanggal_transact']; ?></td>
                                    <td><?php echo $x['cara_bayar']; ?></td>
                                    <td>
                                        <?php 
                                    if ($x['status_kirim'] == 0 && $x['batal_beli'] == 0) {                                    
                                    ?>
                                        <div class="alert alert-warning" role="alert">
                                            Belum Dikirim
                                        </div>
                                    <?php } elseif($x['status_kirim'] == 1){?>
                                        <div class="alert alert-success" role="alert">
                                            Sudah Dikirim.
                                        </div>
                                    <?php } elseif($x['batal_beli'] == 1){?>
                                        <div class="alert alert-danger" role="alert">
                                            Belanjaan Dibatalkan.
                                        </div>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <a
                                            href="transaksiDetail.php?id=<?php echo $coded->encrypt($x['id_transaksi'],$key); ?>"
                                            class="btn btn-primary">Lihat</a>
                                        <?php 
                                    if ($x['status_kirim'] == 1) {                                    
                                    ?>
                                        <a
                                            href="printpdf.php?id=<?php echo $coded->encrypt($x['id_transaksi'],$key); ?>"
                                            class="btn btn-primary">PDF</a>
                                        <?php } ?>

                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col-lg-9 -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

        <!-- Footer -->

        <!-- Bootstrap core JavaScript -->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script>
            // Replace the <textarea id="editor1"> with a CKEditor 4 instance, using default
            // configuration.
            CKEDITOR.replace('editor1');
        </script>

    </body>

</html>