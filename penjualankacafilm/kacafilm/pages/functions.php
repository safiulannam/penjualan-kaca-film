<?php 
//koneksi database
$koneksi = mysqli_connect("localhost", "root", "" ,"penjualankacafilm");

function query($query){
    global $koneksi;

    $result= mysqli_query ($koneksi, $query);
    $rows=[];
    while ($row=mysqli_fetch_assoc($result)){
        $rows[]=$row;
    }
    return $rows;
}

function register($data){
    global $koneksi;
    $kode_user = htmlspecialchars($data["kode_user"]);
    $nama_user = htmlspecialchars($data["nama_user"]);
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    //cek username sudah ada / belum
    $result=mysqli_query($koneksi, "SELECT username FROM user Where username = '$username'");

    if(mysqli_fetch_assoc($result)) {
        echo "
        <script>
        alert('username sudah terdaftar');
        </script>
        ";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan user baru ke database
    mysqli_query($koneksi, "INSERT INTO user VALUES ('$kode_user','$nama_user', '$username', '$password')");
    return mysqli_affected_rows($koneksi);
}

//edit user
function edituser($data){
    global $koneksi;
    $kode_user = htmlspecialchars($data["kode_user"]);
    $nama_user = htmlspecialchars($data["nama_user"]);
    $username = strtolower(stripslashes($data["username"]));

    $query ="UPDATE user SET kode_user = '$kode_user', nama_user = '$nama_user', username = '$username' WHERE kode_user = '$kode_user' ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

//edit password
function gantipassword($data){
    global $koneksi;

    $password_lama = mysqli_real_escape_string($koneksi, $data["password_lama"]);
    $password_baru = mysqli_real_escape_string($koneksi, $data["password_baru"]);
    $password_baru2 = mysqli_real_escape_string($koneksi, $data["password_baru2"]);

    $result = mysqli_query($koneksi,"SELECT *FROM user WHERE kode_user = '$_SESSION[kode_user]'");
    $data = mysqli_fetch_array($result);
    $pass = password_verify($password_lama, $data['password']);

    if($pass === TRUE){
        if ($password_baru !== $password_baru2) {
            echo "
            <script>
            alert ('Konfirmasi Password Tidak Sesuai');
            </script> ";

            return false;
        }

        $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
        $query = "UPDATE user SET password = '$password_baru' WHERE kode_user = '$_SESSION[kode_user]'";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}

//menambahkan data pelanggan 
function tambahpelanggan($data){
    global $koneksi;
    $kode_pelanggan = htmlspecialchars($data["kode_pelanggan"]);
    $nama_pelanggan = htmlspecialchars($data["nama_pelanggan"]);
    $telepon = htmlspecialchars($data["telepon"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $email = htmlspecialchars($data["email"]);

    $query = "INSERT INTO pelanggan VALUES ('$kode_pelanggan', '$nama_pelanggan', '$telepon', '$alamat','$email')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

//membuat hapus data pelanggan
function hapuspelanggan($kode_pelanggan){
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM pelanggan WHERE kode_pelanggan = '$kode_pelanggan' ");

    return mysqli_affected_rows($koneksi);
}

//membuat edit data pelanggan
function editpelanggan($data){
    global $koneksi;
    $kode_pelanggan = htmlspecialchars($data["kode_pelanggan"]);
    $nama_pelanggan = htmlspecialchars($data["nama_pelanggan"]);
    $telepon = htmlspecialchars($data["telepon"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $email = htmlspecialchars($data["email"]);

    $query = "UPDATE pelanggan SET kode_pelanggan = '$kode_pelanggan', nama_pelanggan = '$nama_pelanggan', telepon = '$telepon', alamat = '$alamat', email = '$email' WHERE kode_pelanggan = '$kode_pelanggan'";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

//membuat untuk harga rupiah pada data barang
function rupiah($angka) {
    $hasil_rupiah = number_format($angka,2,',','.');
    return $hasil_rupiah;
}

//membuat tambah barang 
function tambahbarang($data){
    global $koneksi;

    $kode_barang = htmlspecialchars($data["kode_barang"]);
    $nama_barang = htmlspecialchars($data["nama_barang"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);

    $query = "INSERT INTO barang VALUES ('$kode_barang', '$nama_barang', '$harga', '$stok')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

//membuat hapus data barang
function hapusbarang($kode_barang){
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM barang WHERE kode_barang = '$kode_barang' ");

    return mysqli_affected_rows($koneksi);
}

//edit barang
function editbarang($data){
    global $koneksi;
    $kode_barang = htmlspecialchars($data["kode_barang"]);
    $nama_barang = htmlspecialchars($data["nama_barang"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);

    $query = "UPDATE barang SET kode_barang = '$kode_barang', nama_barang = '$nama_barang', harga = '$harga', stok = '$stok' WHERE kode_barang = '$kode_barang'";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

//membuat tambah transaksi
function tambahtransaksi($data){
    global $koneksi;

    $kode_jual = htmlspecialchars($data["kode_jual"]);
    $kode_user = htmlspecialchars($_SESSION["kode_user"]);
    $kode_pelanggan = htmlspecialchars($data["nama_pelanggan"]);
    $kode_barang = htmlspecialchars($data["nama_barang"]);
    $harga = htmlspecialchars($data["harga"]);
    $Jumlah = htmlspecialchars($data["Jumlah"]);

    $stok = mysqli_query($koneksi, "SELECT * FROM barang WHERE kode_barang = '$kode_barang'");
    $data = mysqli_fetch_array($stok);

    if($Jumlah > $data['stok']){
        echo "<script>
        alert ('Jumlah Barang Tidak Cukup');
        document.location.href='transaksi.php';
        </script>";
        exit;
    } else {
        $sql = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE kode_barang = '$kode_barang' AND kode_user = '$kode_user'");
        $ketemu = mysqli_num_rows($sql);

        if($ketemu === 0){
            mysqli_query($koneksi, "INSERT INTO keranjang(kode_jual, kode_user, kode_pelanggan, kode_barang, harga, Jumlah) VALUES ('$kode_jual', '$kode_user', '$kode_pelanggan', '$kode_barang' ,'$harga' ,'$Jumlah')");
            
        } else {
            mysqli_query($koneksi,"UPDATE keranjang SET Jumlah = Jumlah + $Jumlah WHERE kode_barang = '$kode_barang' AND kode_user = '$_SESSION[kode_user]' ");
            
        }
    }
    return mysqli_affected_rows($koneksi);
}

//membuat hapus transaksi
function hapustransaksi($kode_jual){
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM keranjang WHERE kode_jual = '$kode_jual' ");

    return mysqli_affected_rows($koneksi);
}

?>