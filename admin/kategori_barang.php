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

                    <h3 class="my-4">Kategori Barang</h3>
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
                        <h5>List Kategori Barang</h5>
                        <!-- tambah kategori -->
                        <button
                            type="button"
                            class="btn btn-primary float-right"
                            data-toggle="modal"
                            data-target="#tmbhkat">
                            Tambah Kategori
                        </button>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="kat_barang">
                                <?php
                                include '../config/db.php';
                                $db = new database();
                                $koneksi = $db->koneksi();
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    # code...
                                    $nama_kategori=$_POST['nama_kategori'];
                                    $data = mysqli_query($koneksi,"insert into kategori_barang (`id_kat_barang`,`nama_kategori`) values(NULL,'$nama_kategori')");
                                }
                                $no = 1;
                                //query ambil data
                                $data = mysqli_query($koneksi,'select * from kategori_barang');
                                // ambil data dengan memasukkan kedalam array dan dibuat pengulangan while untuk menampilkan data
                                while($d = mysqli_fetch_array($data)){
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $no; ?></th>
                                    <td><?php echo $d['nama_kategori']; ?></td>
                                    <td>
                                        <a
                                            href="javascript:;"
                                            class="text-white btn btn-warning  item_edit"
                                            data="<?php echo $d['id_kat_barang']; ?>">Edit</a>
                                        <a
                                            href="javascript:;"
                                            class="text-white btn btn-danger  item_hapus"
                                            data="<?php echo $d['id_kat_barang']; ?>">Hapus</a>
                                    </td>
                                </tr>
                                <?php $no++;} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col-lg-9 -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->
        <!-- Modal -->
        <div
            class="modal fade"
            id="tmbhkat"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                        <div class="form-group">
                            <label for="fakultas">Nama Kategori</label>
                            <input
                                type="text"
                                class="form-control"
                                aria-describedby="fakultasHelp"
                                placeholder="Kategori Barang ..."
                                name="nama_kategori"
                                required="required">
                            <small id="fakultasHelp" class="form-text text-muted">Masukkan Nama Kategori.</small>
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

        <!-- Modal -->
        <div
            class="modal fade"
            id="ModalEdit"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fakultas">Nama Kategori</label>
                            <input
                                name="id_kat_barang"
                                id="id_kat_barang"
                                class="form-control"
                                type="text"
                                placeholder="Nama Barang"
                                style="width:335px;"
                                hidden="hidden">
                            <input
                                type="text"
                                class="form-control"
                                id="nama_kategori"
                                aria-describedby="fakultasHelp"
                                placeholder="Kategori Barang ..."
                                name="nama_kategori"
                                required="required">
                            <small id="fakultasHelp" class="form-text text-muted">Masukkan Nama Kategori.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn_update">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->

        <!-- Bootstrap core JavaScript -->
        <script src="../assets/vendor/jquery/jquery.min.js"></script>
        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                //GET UPDATE
                $('#kat_barang').on('click', '.item_edit', function () {
                    var id = $(this).attr('data');
                    console.log(id);
                    $.ajax({
                        type: "GET",
                        url: "aksi/katbarang_getedit?id" + id,
                        dataType: "JSON",
                        data: {
                            id: id
                        },
                        success: function (data) {
                            console.log(data.nama_kategori);
                            $('#ModalEdit').modal('show');
                            $('[name="id_kat_barang"]').val(data.id_kat_barang);
                            $('[name="nama_kategori"]').val(data.nama_kategori);
                        }
                    });
                });

                // update kategori
                $('#btn_update').on('click', function () {
                    var id_kat_barang = $('#id_kat_barang').val();
                    var nama_kategori = $('#nama_kategori').val();
                    // console.log(nama_kategori)
                    $.ajax({
                        type: "POST",
                        url: "aksi/katbarang_getedit",
                        dataType: "JSON",
                        data: {
                            id_kat_barang: id_kat_barang,
                            nama_kategori: nama_kategori,
                            update: true
                        },
                        success: function (data) {
                            // $('#ModalEdit').modal('hide');
                            // console.log(data)
                            location.reload();
                        }
                    });
                });

                 // GET HAPUS
                $('#kat_barang').on('click', '.item_hapus', function () {
                    var id_kat_barang = $(this).attr('data');
                    // console.log(id);
                    $.ajax({
                        type: "POST",
                        url: "aksi/katbarang_hapus",
                        dataType: "JSON",
                        data: {
                            id_kat_barang: id_kat_barang,
                            hapus: true
                        },
                        success: function (data) {
                            // $('#ModalEdit').modal('hide');
                            // console.log(data)
                            location.reload();
                        }
                    });
                    // $('#ModalHapus').modal('show');
                    // $('[name="kode"]').val(id);
                });
            });
        </script>

    </body>

</html>