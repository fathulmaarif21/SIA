<?php

include "config.php";
include "tanggal.php";
//libraby
require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/* Fill in your own connector here */
//$connector = new FilePrintConnector("php://stdout");
$connector = new WindowsPrintConnector("58mm");

session_start();

function isi_keranjang()
{
    global $koneksi;

    $isikeranjang = array();
    $sid = session_id();
    $sql = mysqli_query($koneksi,"SELECT * FROM orders_temp WHERE id_session='$sid'");

    while ($r = mysqli_fetch_array($sql)) {
        $isikeranjang[] = $r;
    }
    return $isikeranjang;
}

$isikeranjang = isi_keranjang();
$jml = count($isikeranjang);

if ($jml == 0) {
    echo "<script> alert('Product masih kosong'); location.href='index.php?hal=pos' </script>";
    exit();
}

//$tgl_skrg = date("Y-m-d");
  $jam_skrg = date("H:i:s");

// simpan data pemesanan
mysqli_query($koneksi,"INSERT INTO
                orders(nama_petugas, tgl_order, jam_order)
                 VALUES ('" . $_SESSION['username'] . "',NOW(),'$jam_skrg')");
//exit();
// mendapatkan nomor orders
$id_orders = mysqli_insert_id($koneksi);
// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan


// simpan data detail pemesanan
for ($i = 0; $i < $jml; $i++) {
    mysqli_query($koneksi,"INSERT INTO orders_detail(id_orders, product_id, jumlah)
                   VALUES('$id_orders',{$isikeranjang[$i]['product_id']}, {$isikeranjang[$i]['jumlah']})");

    mysqli_query($koneksi,"UPDATE product SET product_stock=product_stock - {$isikeranjang[$i]['jumlah']} WHERE product_id={$isikeranjang[$i]['product_id']}");

}
//exit();
for ($i = 0; $i < $jml; $i++) {

    mysqli_query($koneksi,"DELETE FROM orders_temp WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
}
//exit();
$daftarproduk = mysqli_query($koneksi,"SELECT * FROM orders_detail,product
                                     WHERE orders_detail.product_id=product.product_id
                                     AND id_orders='$id_orders'");

//total barang dan masukin array
  $CetakNota = mysqli_query($koneksi,"SELECT * FROM orders_detail,product
                                  WHERE orders_detail.product_id=product.product_id
                                  AND id_orders='$id_orders'");

    $totalcetak = 0;
    $itemcetak = 0;
    $subtotal = 0;
    $subtotalcetak =0;

    $items = array();

    while ($datacetak = mysqli_fetch_assoc($CetakNota)) {
    //-------------------------------------------------
    $subtotalcetak = +$datacetak['jumlah'] * $datacetak['product_price'];
    $totalcetak += $subtotalcetak;
    $itemcetak += $datacetak['jumlah'];

    $o = new barang();
    //$o->name  = $datacetak['product_name'];
    //$o->price = $datacetak['product_price'];
    //$o->qty   = $datacetak['jumlah'];
    //array_push($items, $o);

    $o->nama    = $datacetak['product_name'];
    $o->harga   = $datacetak['product_price'];
    $o->qty     = $datacetak['jumlah'];
    array_push($items, $o);
  }

//exit();

/* Start the printer */
$logo = EscposImage::load("assets/images/logo2.png", false);
$printer = new Printer($connector);

/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->bitImage($logo);

/* Name of shop */
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("\n");
//$printer -> feed(2);
$printer -> text("ExampleMart Ltd.\n");
//------------------------------------------------------
$printer -> selectPrintMode();
$printer -> text("Jl. RAYA TANJUNG KM 5 BLENCONG.\n");
$printer -> text("GUNUNG SARI LOMBOK BARAT.\n");
$printer -> text("TLP. 0212345859.\n");
$printer -> text("NPWP : 09.000.000.000.00.9-888.\n");
$printer -> feed();

/* Title of receipt */
$printer -> feed();
$printer -> setEmphasis(true);
$printer -> text("SALES INVOICE\n");
$printer -> text("Nota : ".$id_orders." Kasir : ".$_SESSION['username']);
$printer -> text("\n");
$printer -> setEmphasis(false);

$subtotal = new item('Subtotal', $totalcetak);
$tax = new item('A local tax', 0);
$total = new item('Total', $totalcetak,0);

$kembalian = str_replace(".", "", $_POST['cash']) - $totalcetak;
$kembali = new item('Kembalian', $kembalian,0);
$cash = new item('Cash', $_POST['cash'],0);

/* Items */
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
//$printer -> text(new item('', '$'));

$printer -> text("\n");
$printer -> feed(1);
$printer -> setEmphasis(false);
$printer -> text("--------------------------------");
foreach ($items as $item) {
    $printer -> text($item);
}
$printer -> text("--------------------------------");

$printer -> feed();
$printer -> setEmphasis(true);
$printer -> text($subtotal);
$printer -> setEmphasis(false);

/* Tax and total */
$printer -> text($tax);
$printer -> feed();
//$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> setEmphasis(true);
$printer -> text($total);
$printer -> selectPrintMode();
$printer -> text($cash);
$printer -> text($kembali);
$printer -> selectPrintMode();

/* Footer */
$printer -> feed(2);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("Thank you for shopping at ExampleMart\n");
$printer -> text("For trading hours, please visit example.com\n");
$printer -> feed(2);
$printer -> text($jam_skrg. "\n");

/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> pulse();

$printer -> close();

/* A wrapper to do organise item names & prices into columns */
class barang {
   public $nama = null;
   public $harga  = null;
   public $qty  = null;

   public function __toString()
   {
       $rightCols = 15;
       $leftCols = 27;
       if ($this -> dollarSign) {
           $leftCols = $leftCols / 2 - $rightCols / 2;
       }

       $isibarang = $this -> qty. ' ' .$this -> nama;

       $left = str_pad($isibarang, $leftCols) ;
       //$left = str_pad($left, ' ', $this -> qty, $leftCols) ;

       //$sign = ($this -> dollarSign ? 'Rp ' : '');
       $right = str_pad($this -> harga, $rightCols);
       return "$left$right\n";
   }
}

class item
{
    private $name;
    private $qty;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $qty = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> qty = $qty;
        $this -> dollarSign = $dollarSign;
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 20;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> dollarSign ? 'Rp ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }

}
