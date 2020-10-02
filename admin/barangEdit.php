<?php
include 'barangClass.php';
$db = new Barang();
$koneksi = $db->koneksi();
if (!$_GET['id'] && !$_GET['aksi'] == 'edit') {
    # code...
    header("location:barang.php");
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

                    <h3 class="my-4">Edit Barang</h3>
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
                        <h5>Edit Barang</h5>
                        <form action="barangRoute.php?aksi=update" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="fakultas">Pilih Kategori Barang</label>
                                <select name="id_kat_barang" class="form-control" id="fakultas">
                                    <?php foreach($db->getKategori() as $u){  ?>
                                    <option value="<?php echo $u['id_kat_barang'] ?>" <?php echo ($u['id_kat_barang'] == $db->getEdit($_GET['id'])->id_kat_barang) ? 'selected' : ''; ?>><?php echo $u['nama_kategori'] ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_barag">Nama Barang</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    aria-describedby="fakultasHelp"
                                    placeholder="Kategori Barang ..."
                                    name="nama_barag"
                                    required="required"
                                    value="<?php echo $db->getEdit($_GET['id'])->nama_barag ?>">
                                <small id="fakultasHelp" class="form-text text-muted">Masukkan Nama Barang.</small>
                            </div>
                            <div class="form-group">
                                <label for="editor1">Deskripsi Barang</label>
                                <textarea class="form-control" name="deskripsi_barang" id="editor1"><?php echo $db->getEdit($_GET['id'])->deskripsi_barang ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="stok_barang">Stok Barang</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    aria-describedby="fakultasHelp"
                                    placeholder="Stok Barang ..."
                                    name="stok_barang"
                                    required="required"
                                    value="<?php echo $db->getEdit($_GET['id'])->stok_barang ?>">
                                <small id="fakultasHelp" class="form-text text-muted">Masukkan Stok Barang.</small>
                            </div>
                            <div class="form-group">
                                <label for="fakultas">Harga Barang</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    aria-describedby="fakultasHelp"
                                    placeholder="Harga Barang ..."
                                    name="harga_barang"
                                    required="required"
                                    value="<?php echo $db->getEdit($_GET['id'])->harga_barang ?>">
                                <small id="fakultasHelp" class="form-text text-muted">Masukkan Harga Barang.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Gambar Barang</label> <br> <small>Gambar Saat ini.</small> <br>
                                <input type="text" name="id"value="<?php echo $_GET['id'];?>" hidden>
                                <input hidden type="text" name="old_foto" value="<?php echo $db->getEdit($_GET['id'])->foto_barang;?>">
                                <img src="../assets/img/<?php echo $db->getEdit($_GET['id'])->foto_barang;?>" alt="" width="80" class="img-responsive">
                                <input
                                    type="file"
                                    name="foto[]"
                                    class="form-control-file"
                                    id="exampleFormControlFile1"
                                    multiple="multiple">
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Update !</button>
                        </form>
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