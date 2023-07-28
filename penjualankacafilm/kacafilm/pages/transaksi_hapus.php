<?php
require 'functions.php';

$kode_jual = $_GET["kode_jual"];

if(hapustransaksi($kode_jual) > 0){
    echo "
    <script>
    alert('Data Transaksi Berhasil Dihapus');
    document.location.href='transaksi.php';
    </script>";
} else {
    echo "
    <script>
    alert('Data Transaksi Gagal Dihapus');
    document.location.href='transaksi.php';
    </script>";
}
?>