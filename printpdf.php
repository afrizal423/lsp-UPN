<?php
require_once __DIR__ . '/vendor/autoload.php';

include 'indexClass.php';
include 'config/coded.php';
$db = new indexClass();
$key = 'afrizal muhammad yasin';
// $db = new transaksi();
$coded = new Coded();

$koneksi = $db->koneksi();
if(!isset($_GET['id'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$mpdf = new \Mpdf\Mpdf([
    'tempDir' => __DIR__ . 'temp/pdf',
    'format' => 'A4-P',
    ]);
// $mpdf->WriteHTML('<h1>Hello world!</h1>');
// $mpdf->Output();
$idnya = $coded->decrypt($_GET['id'],$key);
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

    </head>
    <body>
        <div style="text-align: center;">
            <h3>
                <b>Toko Alat Kesehatan
                    <br>Laporan Belanja Anda</b>
            </h3>
        </div>
        <br>
        <!-- ------------------------------------------------------ -->
        <table>
            <?php 
                            $no = 1;
                            $loop = 1;
                            // echo json_encode($db->listbelanjaanpdf($idnya));
                            foreach($db->listbelanjaanpdf($idnya) as $x){
                            ?>
            <tr>
                <td>
                    Nama:
                    <br>
                    <?php echo $x['nama_client']; ?>
                    <br>
                    Alamat :
                    <br>
                    <?php echo $x['alamat']; ?>
                    <br>
                    No HP :
                    <br>
                    <?php echo $x['no_hp']; ?>

                </td>

                <td style="padding-left:310px">
                    Tanggal :
                    <br>
                    <?php echo $x['tanggal_transact']; ?>
                    <br>
                    ID Paypal :
                    <br>
                    <?php echo $x['paypal_id']; ?>
                    <br>
                    Cara Bayar :
                    <br>
                    <?php echo $x['cara_bayar']; ?>

                </td>
            </tr>
            <?php 
            if ($loop == 1) {
                # code...
            break;
            }
        } ?>
        </table>

        <!-- ------------------------------------------------------ -->
        <br><br>
        <table style="width:100%;border: 1px solid black;">
            <tr style="border: 1px solid black;">
                <th style="border: 1px solid black;">No</th>
                <th style="border: 1px solid black;">Nama Produk</th>
                <th style="border: 1px solid black;">Jumlah</th>
                <th style="border: 1px solid black;">Harga</th>
            </tr>
            <?php 
                            $no = 1;
                            // echo json_encode($db->listbelanjaanpdf($idnya));
                            foreach($db->listbelanjaanpdf($idnya) as $x){
                            ?>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;"><?php echo $no++; ?>
                </td>
                <td style="border: 1px solid black;"><?php echo $x['nama_barag']; ?>

                </td>
                <td style="border: 1px solid black;"><?php echo $x['jumlah_pembelian']; ?>

                </td>
                <td style="border: 1px solid black;"><?php echo $x['harga']; ?>

                </td>
            </tr>
            <?php } ?>
        </table>
        <br>
        <div>
            <p>
                Total belanja (termasuk pajak):
                <b>
                    <u>
                        <?php $s = 0; foreach($db->listbelanjaanpdf($idnya) as $x)
                        {
                            $s += $x['harga'];;
                        } 
                        echo $db->rupiah((10/100*$s)+$s);?>
                        <?php //echo $harga;?>
                    </u>
                </b>

            </p>
        </div>
        <br>
        <div style="text-align: right;">
            <b>
                <u>
                    TANDA TANGAN TOKO
                </u>
            </b>
        </div>
    </body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML(utf8_encode($html));

// jika ingin labgsung download pake ini
// $mpdf->Output('MyPDF.pdf', 'D');

// jika ingin di view pake ini
$mpdf->Output();
?>