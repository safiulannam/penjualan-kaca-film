<?php
require 'functions.php';

$kode_pelanggan = $_GET["kode_pelanggan"];

if(hapuspelanggan($kode_pelanggan) > 0){
    echo "
    <script>
    alert('Data Pelanggan Berhasil Dihapus');
    document.location.href='pelanggan.php';
    </script>";
} else {
    echo "
    <script>
    alert('Data Pelanggan Gagal Dihapus');
    document.location.href='pelanggan.php';
    </script>";
}
?>