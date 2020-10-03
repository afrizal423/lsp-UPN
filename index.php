<?php
include 'indexClass.php';
include 'config/coded.php';
$idx = new indexClass();
$coded = new Coded();
$koneksi = $idx->koneksi();
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
                            <a class="nav-link" href="#">Register</a>
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
                    <small>Kategori :</small>
                    <?php 
                            $no = 1;
                            foreach($idx->listkategori() as $x){
                            ?>
                        <a href="index.php?kategori=<?php echo $coded->encrypt($x['id_kat_barang'],$key) ?>" class="list-group-item"><?php echo $x['nama_kategori'];?></a>
                    <?php } ?>
                    </div>

                </div>
                <!-- /.col-lg-3 -->

                <div class="col-lg-9">

                    <!-- <div id="carouselExampleIndicators" class="carousel slide my-4"
                    data-ride="carousel"> <ol class="carousel-indicators"> <li
                    data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li> <li
                    data-target="#carouselExampleIndicators" data-slide-to="2"></li> </ol> <div
                    class="carousel-inner" role="listbox"> <div class="carousel-item active"> <img
                    class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
                    </div> <div class="carousel-item"> <img class="d-block img-fluid"
                    src="http://placehold.it/900x350" alt="Second slide"> </div> <div
                    class="carousel-item"> <img class="d-block img-fluid"
                    src="http://placehold.it/900x350" alt="Third slide"> </div> </div> <a
                    class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                    data-slide="prev"> <span class="carousel-control-prev-icon"
                    aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a
                    class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                    data-slide="next"> <span class="carousel-control-next-icon"
                    aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div> -->
                    <?php
                    if(isset($_GET['kategori'])) {
                        $temp = $idx->lihatkategori($coded->decrypt($_GET['kategori'],$key));
                        $id=$coded->decrypt($_GET['kategori'],$key);
                        $data = mysqli_query($idx->koneksi(),"select * from kategori_barang where id_kat_barang='".$id."'");
                        $hasil = mysqli_fetch_object($data);
                        echo "<h3>Lihat Kategori : ". $hasil->nama_kategori ."</h3>";
                    } else {
                        $temp = $idx->indexAwal();
                    }
                    ?>
                    <div class="row my-4">
                        <?php 
                            $no = 1;                            
                            foreach($temp as $x){
                            ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="lihatbarang.php?barang=<?php echo $idx->encode($x['id_barang']); ?>"><img
                                    class="card-img-top"
                                    style="height: 200px;"
                                    src="assets/img/<?php echo $x['foto_barang'];?>"
                                    alt=""></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="lihatbarang.php?barang=<?php echo $idx->encode($x['id_barang']); ?>"><?php echo $x['nama_barag']; ?></a>
                                    </h4>
                                    <h5><?php echo $idx->rupiah($x['harga_barang']); ?></h5>

                                </div>
                                <div class="card-footer container">
                                    <div class="row">
                                        <div class="col-sm">
                                            <small class="text-muted">
                                                <a href="lihatbarang.php?barang=<?php echo $idx->encode($x['id_barang']); ?>">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    <br>Lihat Produk</small>
                                            </a>

                                        </div>
                                        <div class="col-sm">
                                            <?php
                                            if (isset($_SESSION['status']) && $_SESSION['status']=='login' && $_SESSION['level'] == 'client') {
                                            ?>
                                            <small class="text-muted">
                                                <a
                                                    href="indexRoute.php?barang=<?php echo $idx->encode($x['id_barang']); ?>&aksi=<?php echo $idx->encode('tambahcart'); ?>">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                    <br>Beli Sekarang
                                                </a>
                                            </small>
                                            <?php } else { ?>
                                                <small class="text-muted">
                                                <a
                                                    href="login.php">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                    <br>Beli Sekarang
                                                </a>
                                            </small>


                                            <?php } ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- Silahkan di looping -->

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