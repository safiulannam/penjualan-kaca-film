<?php
require 'functions.php';

$kode_barang = $_GET["kode_barang"];

if(hapusbarang($kode_barang) > 0){
    echo "
    <script>
    alert('Data Barang Berhasil Dihapus');
    document.location.href='barang.php';
    </script>";
} else {
    echo "
    <script>
    alert('Data Barang Gagal Dihapus');
    document.location.href='barang.php';
    </script>";
}
?>