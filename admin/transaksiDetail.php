<?php
include 'transaksiClass.php';
$db = new transaksi();
$koneksi = $db->koneksi();
if(isset($_POST['update'])) {
    // echo json_encode($_POST);
    $db->updatekirim($_POST);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
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
                        <h5>Detail Transaksi :</h5>
                        <!-- tambah kategori -->
                        <a href="historytransaksi.php" class="btn btn-primary float-right">History Transaksi</a>

                        <table class="table table-responsive table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            $no = 1;
                            if (isset($_GET['id'])) {
                                # code...
                                $temp = $db->listbelanjaan($_GET['id']);
                            }
                            foreach($temp as $x){
                                $kirim = $x['status_kirim'];
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++; ?></th>
                                    <td><?php echo $x['nama_barag']; ?></td>
                                    <td><?php echo $x['jumlah_pembelian']; ?></td>
                                    <td><?php echo $db->rupiah($x['harga_barang']); ?></td>
                                    <td>
                                        <?php echo $db->rupiah($x['harga']); ?>
                                    </td>

                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="container text-right">
                            <b>Total Belanja (termasuk pajak):
                                <br>
                                <?php $s = 0; foreach($temp as $x)
                        {
                            $s += $x['harga'];;
                        } 
                        echo $db->rupiah((10/100*$s)+$s);?>
                                <?php //echo $harga;?></b>
                        </div>
                    </div>
                    <div class="card">
                        <?php 
                                    if ($x['status_kirim'] == 0) {                                    
                                    ?>
                        <div class="alert alert-warning" role="alert">
                            Semua barang ini belum Dikirim!.
                        </div>
                        <h4>Apakah sudah dikirim?</h4><br>
                        <small>Silahkan ubah pada form dibawah ini.</small> <br>
                        <form method="post">
                            <input type="text" name="id_transaksi" value="<?php echo $_GET['id']; ?>" hidden>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status Kirim</label>
                                <select name="status_kirim" class="form-control" id="exampleFormControlSelect1">
                                    <option>--- Silahkan Pilih ---</option>
                                    <option value="1">Sudah dikirim</option>
                                    <option value="0">Belum Dikirim</option>
                                </select>
                            </div>
                            <input type="hidden" name="update">
                            <button type="submit" class="btn btn-primary float-right">Update!</button>
                        </form>
                    <?php } elseif($x['status_kirim'] == 1){?>
                        <div class="alert alert-success" role="alert">
                            Sudah Dikirim.
                        </div>
                        <?php } ?>
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