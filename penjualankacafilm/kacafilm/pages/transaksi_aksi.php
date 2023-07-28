<?php
session_start();

if (!isset($_SESSION["login"])){
    header("Location:login.php");
    exit;    
}

require 'functions.php';
function isi_keranjang($koneksi){
    $isikeranjang = array();
    $sql = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE kode_user = '$_SESSION[kode_user]' ");

    while ($r = mysqli_fetch_array($sql)){
        $isikeranjang[] = $r;
    } 
    return $isikeranjang;
}
$tanggal = date("Ymd");
$waktu = date("His");
$kode_jual = "JUAL" . $tanggal . $waktu;

$isikeranjang = isi_keranjang($koneksi);
$jml = count($isikeranjang);

for ($i=0; $i<$jml; $i++) {
    // $kode_jual = $isikeranjang[$i]['kode_jual'];
    $kode_barang = $isikeranjang[$i]['kode_barang'];
    $harga = $isikeranjang[$i]['harga'];
    $Jumlah = $isikeranjang[$i]['Jumlah'];
    $subtotal = $isikeranjang[$i]['Jumlah'] * $isikeranjang[$i]['harga'];

    // mysqli_query($koneksi, "INSERT INTO detail_jual(kode_jual, kode_barang, harga, Jumlah , subtotal) VALUES ('{$kode_jual}', '{$kode_barang}', 
    // {$harga}, {$Jumlah}, {$subtotal} )");
    // Cek keberadaan kode_jual pada tabel detail_jual
    while (cekKodeJual($koneksi, $kode_jual)) {
        $waktu = intval($waktu) + 1; // Tambahkan 1 pada waktu
        $kode_jual = "JUAL" . $tanggal . str_pad($waktu, 6, '0', STR_PAD_LEFT);
    }

    // mysqli_query($koneksi, "INSERT INTO detail_jual(kode_jual, kode_barang, harga, Jumlah , subtotal) VALUES ('$kode_jual', '$kode_barang', $harga, $Jumlah, $subtotal)");   
    $query = "INSERT INTO detail_jual(kode_jual, kode_barang, harga, Jumlah , subtotal) VALUES ('$kode_jual', '$kode_barang', $harga, $Jumlah, $subtotal)";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "Error: " . mysqli_error($koneksi);
        exit;
    }
}


for ($i=0; $i<$jml; $i++){
    $kode_jual = $isikeranjang[$i]['kode_jual'];
    $kode_user = $isikeranjang[$i]['kode_user'];
    $kode_pelanggan = $isikeranjang[$i]['kode_pelanggan'];
    $total = $isikeranjang[$i]['Jumlah'] * $isikeranjang[$i]['harga'];

    // mysqli_query($koneksi, "INSERT INTO jual(kode_jual, kode_user, kode_pelanggan, total, tanggal) VALUES ('{$kode_jual}', '{$kode_user}', 
    // '{$kode_pelanggan}', {$total}, '{$tanggal}' )");
    // mysqli_query($koneksi, "INSERT INTO jual(kode_jual, kode_user, kode_pelanggan, total, tanggal) VALUES ('$kode_jual', '$kode_user', '$kode_pelanggan', $total, '$tanggal')");   
    $query = "INSERT INTO jual(kode_jual, kode_user, kode_pelanggan, total, tanggal) VALUES ('$kode_jual', '$kode_user', '$kode_pelanggan', $total, '$tanggal')";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "Error: " . mysqli_error($koneksi);
        exit;
    }
}

for ($i=0; $i<$jml; $i++){
    $kode_barang = $isikeranjang[$i]['kode_barang'];
    $Jumlah = $isikeranjang[$i]['Jumlah'];
    // mysqli_query($koneksi, "UPDATE barang SET stok = stok - $Jumlah WHERE kode_barang = '$kode_barang'");
    $query = "UPDATE barang SET stok = stok - $Jumlah WHERE kode_barang = '$kode_barang'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "Error: " . mysqli_error($koneksi);
        exit;
    }
}

for ($i=0; $i<$jml; $i++){
    // mysqli_query($koneksi, "DELETE FROM keranjang WHERE kode_jual = '{$isikeranjang[$i]['kode_jual']}' ");
    $query = "DELETE FROM keranjang WHERE kode_jual = '{$isikeranjang[$i]['kode_jual']}'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "Error: " . mysqli_error($koneksi);
        exit;
    }
}

echo "<script>
alert('Data Berhasil Terjual');
document.location.href = 'jual.php';
</script>";

// Fungsi untuk memeriksa keberadaan kode_jual pada tabel detail_jual
function cekKodeJual($koneksi, $kode_jual)
{
    $query = "SELECT COUNT(*) as total FROM detail_jual WHERE kode_jual = '$kode_jual'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'] > 0;
}

?>