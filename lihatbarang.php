<?php
include 'indexClass.php';
include 'config/coded.php';

$idx = new indexClass();
$coded = new Coded();
$koneksi = $idx->koneksi();
$obj = $idx->lihatBarang($_GET['barang']);
$key = 'afrizal muhammad yasin';

session_start();
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

                <div class="col-lg-9">

                    <div class="row my-4">
                        <h2><?php echo $obj->nama_barag?></h2>
                        <br>
                        <!-- Silahkan di looping -->
                        <div class="container">
                            <img src="assets/img/<?php echo $obj->foto_barang;?>" alt="" class="img-fluid">
                            <div class="card">
                                <h3>
                                    <i class="fa fa-money" aria-hidden="true" style="color:green;"></i>
                                    <?php echo $idx->rupiah($obj->harga_barang);?>
                                </h3>
                                <div class="container">
                                    Deskripsi:
                                    <br>
                                    <br>
                                    <?php echo $obj->deskripsi_barang;?>
                                </div>
                                <div class="btn">
                                    <?php
                                            if (isset($_SESSION['status']) && $_SESSION['status']=='login' && $_SESSION['level'] == 'client') {
                                            ?>
                                    <a href="indexRoute.php?barang=<?php echo $idx->encode($obj->id_barang); ?>&aksi=<?php echo $idx->encode('tambahcart'); ?>">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <br>Beli Sekarang
                                    </a>
                                <?php } else { ?>
                                    <a href="login.php">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <br>Beli Sekarang

                                    </a>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.col-lg-9 -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
            </div>
            <!-- /.container -->
        </footer>

        <!-- Bootstrap core JavaScript -->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>

</html>