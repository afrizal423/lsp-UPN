<?php
include 'transaksiClass.php';
$db = new transaksi();
$koneksi = $db->koneksi();
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
        <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../assets/css/shop-homepage.css" rel="stylesheet">
        <script src="../assets/ckeditor/ckeditor.js"></script>

        <link
            rel="../stylesheet"
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
                            <a class="nav-link" href="../logout">logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <div class="card col-lg-3">

                    <h3 class="my-4">Barang</h3>
                    <div class="list-group">
                        <a href="kategori_barang" class="list-group-item">Kategori Barang</a>
                        <a href="barang" class="list-group-item">Barang</a>
                        <a href="transaksi" class="list-group-item">Transaksi</a>
                    </div>

                </div>
                <!-- /.col-lg-3 -->

                <!-- isi konten disini -->
                <div class="card col-lg-9">
                    <div class=" my-4">
                        <h5>List Transaksi</h5>
                        <!-- tambah kategori -->
                        <a href="historytransaksi.php" class="btn btn-primary float-right">History Transaksi</a>

                        <table class="table table-responsive table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Client</th>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Cara Bayar</th>
                                    <th scope="col">Status Kirim</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            $no = 1;
                            foreach($db->tampil_data() as $x){
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++; ?></th>
                                    <td><?php echo $x['nama_client']; ?></td>
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
                                            href="transaksiDetail.php?id=<?php echo $x['id_transaksi']; ?>"
                                            class="btn btn-primary">Lihat</a>

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
        <script src="../assets/vendor/jquery/jquery.min.js"></script>
        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script>
            // Replace the <textarea id="editor1"> with a CKEditor 4 instance, using default
            // configuration.
            CKEDITOR.replace('editor1');
        </script>

    </body>

</html>