<?php
include 'indexClass.php';
$idx = new indexClass();
$koneksi = $idx->koneksi();
session_start();
if(isset($_POST['update'])) {
    $arrQuantity = $_POST['quantity'];
    $cart = unserialize(serialize($_SESSION['cart']));
    
    for($i=0; $i<count($cart);$i++) {
       $cart[$i]['jumlah_barang'] = $arrQuantity[$i];
    }
    $_SESSION['cart'] = $cart;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
  $cart = unserialize(serialize($_SESSION['cart']));
  if (count($cart) == 0) {
      # code...
      echo "<script>alert('Anda belum membeli apapun!');window.location = 'index.php'</script>";
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
                    </div>

                </div>
                <!-- /.col-lg-3 -->

                <div class="col-lg-9">

                    <div class="row my-4">
                        <h3>Keranjang Belanja.</h3>
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            $no = 1;
                            $cart = unserialize(serialize($_SESSION['cart']));
                            $index = 0;
                            for($i=0; $i<count($cart); $i++){
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no;?></th>
                                    <td><?php echo $cart[$i]['nama_barag'];?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input
                                                type="number"
                                                class="form-control"
                                                min="1"
                                                value="<?php echo $cart[$i]['jumlah_barang']; ?>"
                                                name="quantity[]">
                                        </td>
                                        <td><?php echo $idx->rupiah($cart[$i]['harga_barang']);?></td>
                                        <td><?php echo $idx->rupiah($cart[$i]['harga_barang'] * $cart[$i]['jumlah_barang']);?></td>
                                        <td>
                                            <a
                                                class="btn btn-danger"
                                                href="indexRoute.php?posisi=<?php echo $idx->encode($index);?>&aksi=<?php echo $idx->encode('hapuscart'); ?>"
                                                role="button">Batalkan</a>
                                        </td>
                                    </tr>
                                    <?php
                            $no++;
                            $index++; }
                            ?>
                                </tbody>
                            </table>
                            <div class="container text-right">
                                <b>Total Belanja (termasuk pajak):
                                    <br>
                                    <?php $s = 0; for($i=0; $i<count($cart); $i++)
                        {
                            $s += $cart[$i]['harga_barang'] * $cart[$i]['jumlah_barang']; 
                            $index++;
                        } 
                        echo $idx->rupiah((10/100*$s)+$s);?>
                                    <br>
                                    <small>
                                        Jika mengubah pada jumlah barang yang akan dibeli,
                                        <br>
                                        silahkan klik update harga untuk kalkulasi hasil akhir.
                                    </small>
                                    <br>
                                    <a
                                        class="btn btn-danger"
                                        href="indexRoute.php?aksi=<?php echo $idx->encode('deletecart')?>"
                                        role="button">Batal pesan</a>
                                    <input type="hidden" name="update">
                                    <input class="btn btn-warning" type="submit" value="Update Harga">
                                </form>
                                <?php //echo $harga;?></b>
                            <button
                                type="button"
                                class="btn btn-success"
                                data-toggle="modal"
                                data-target="#staticBackdrop">
                                Bayar Sekarang
                            </button>
                        </div>
                        <!-- Silahkan di looping -->

                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.col-lg-9 -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->
        <!-- Modal -->
        <div
            class="modal fade"
            id="staticBackdrop"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Checkout Belanjaan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="indexRoute.php?aksi=<?php echo $idx->encode('checkout')?>" method="post">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Cara Bayar</label>
                                <select class="form-control" name="cara_bayar" id="exampleFormControlSelect1">
                                    <option>--- Silahkan Pilih ---</option>
                                    <option value="Prepaid">Prepaid</option>
                                    <option value="Postpaid">Postpaid</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editor1">Feedback</label>
                                <textarea class="form-control" name="feedback" id="editor1"></textarea>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
        <script>
            // Replace the <textarea id="editor1"> with a CKEditor 4 instance, using default
            // configuration.
            CKEDITOR.replace('editor1');
        </script>
    </body>

</html>