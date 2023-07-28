<?php
session_start();

if (!isset($_SESSION["login"])){
    header("Location:login.php");
    exit;    
}

require 'functions.php';

$nama_user=query("SELECT * FROM user WHERE kode_user = '$_SESSION[kode_user]' ");

if (isset($_POST["tambah_transaksi"])){
    if (tambahtransaksi($_POST) > 0){
        echo "
        <script>
        alert('Data Transaksi Berhasil Di Tambahkan');
        document.location.href = 'transaksi.php';
        </script>";
    } else {
        echo "
        <script>
        alert('Data Transaksi Gagal Di Tambahkan');
        document.location.href = 'transaksi.php';
        </script>";
    }
}

$sql = mysqli_query($koneksi, "SELECT * FROM keranjang");
$ketemu= mysqli_num_rows($sql);

if ($ketemu === 0){ 
$query = mysqli_query ($koneksi, "SELECT MAX(kode_jual) as kodeTerbesar FROM jual");
$data = mysqli_fetch_array($query);
$kodejual = $data['kodeTerbesar'];
$urutan = (int) substr($kodejual , 6, 6);
$urutan++;

$huruf = "JUAL";
$kodejual = $huruf . sprintf("%06s", $urutan);
} else {
    $query = mysqli_query ($koneksi, "SELECT MAX(kode_jual) as kodeTerbesar FROM keranjang");
    $data = mysqli_fetch_array($query);
    $kodejual = $data['kodeTerbesar'];
    $urutan = (int) substr($kodejual , 6, 6);
    $urutan++;

    $huruf = "JUAL";
    $kodejual = $huruf . sprintf("%06s", $urutan);
}

$transaksi = query("SELECT *FROM keranjang INNER JOIN pelanggan ON keranjang.kode_pelanggan = pelanggan.kode_pelanggan INNER JOIN barang ON 
keranjang.kode_barang = barang.kode_barang WHERE kode_user = '$_SESSION[kode_user]' ORDER BY keranjang.kode_jual ASC ");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>APLIKASI PENJUALAN</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

         <!-- DataTables CSS -->
         <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <link rel="shorcut icon" href="../img/pembelian.png">

        <style type="text/css">
            .navbar-inverse {
                background-color: #337ab7;
                border-color: blue;
            }
            li a:hover {
                color: blue;
                text-decoration: none;
            }
            .navbar-header a{
                font-weight: bold;
            }
        </style>
    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
                <div class="navbar-header">
                    <a class="navbar-brand" style="color:white;" href="#">APLIKASI PENJUALAN</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:white;">
                            <i class="fa fa-user fa-fw"></i>
                            <?php foreach ($nama_user as $user) : ?>
                                <?php echo $user["nama_user"]; ?>
                                <?php endforeach; ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                            	<a href="edit_user.php"><i class="fa fa-user fa-fw"></i> Edit Profil</a>
                            </li>
                            <li>
                            	<a href="ganti_password.php"><i class="fa fa-gear fa-fw"></i> Ganti Password</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                            	<a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="index.php"><i class="fa fa-home fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="pelanggan.php"><i class="fa fa-users fa-fw"></i> Data Pelanggan</a>
                            </li>
                            <li>
                                <a href="barang.php"><i class="fa fa-briefcase fa-fw"></i> Data Barang</a>
                            </li>
                            <li>
                                <a href="jual.php"><i class="fa fa-money fa-fw"></i> Data Penjualan</a>
                            </li>
                            <li>
                                <a href="transaksi.php"><i class="fa fa-handshake-o fa-fw"></i> Transaksi</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-print fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="laporan.pelanggan.php">Laporan Pelanggan</a>
                                </li>
                                <li>
                                    <a href="laporan_barang.php">Laporan Barang</a>
                                </li>
                                <li>
                                    <a href="laporan_penjualan.php">Laporan penjualan</a>
                                </li>
                            </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><i class="fa fa-handshake-o fa-fw"></i> Tambah Transaksi</h1>
                        </div>
                    </div>
                            <div class="row">
                                 <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <form class="row" role="form" method="post">
                                                <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label for="kode_jual">Kode Jual</label>
                                                    <input type="text" name="kode_jual" id="kode_jual" class="form-control" value="<?php echo $kodejual ?>">
                                                </div>          
                            <div class="form-group">
                                <label for="nama_pelanggan">Nama Pelanggan</label>
                                <select name="nama_pelanggan" id="nama_pelanggan" class="form-control" required="" autofocus="">
                                    <option value="">Pilih Nama Pelanggan </option>
                                    <?php 
                                    $pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                                    $jsArray = "var prdName = new Array(); \n";
                                    while ($nama_pelanggan = mysqli_fetch_array($pelanggan)){
                                        echo '<option value = "'. $nama_pelanggan['kode_pelanggan'].'">'.
                                        $nama_pelanggan['nama_pelanggan']. '</option>';
                                    }
                                    ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <select name="nama_barang" id="nama_barang" class="form-control" required="" onchange="changeValue(this.value)">
                                    <option value="">Pilih Nama Barang </option>
                                    <?php 
                                    $barang = mysqli_query($koneksi, "SELECT * FROM barang");
                                    $jsArray = "var prdName = new Array(); \n";
                                    while ($nama_barang = mysqli_fetch_array($barang)){
                                        echo '<option value = "'. $nama_barang['kode_barang'].'">'.
                                        $nama_barang['nama_barang']. '</option>';
                                        $jsArray .= "prdName['". $nama_barang['kode_barang']. "'] = {harga : '" .addslashes ($nama_barang['harga'])."'}; \n";
                                    }
                                    ?>
                                    </select>
                                </div>   
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="tambah_transaksi"><i class="fa fa-plus
                                    fa-fw"></i> Tambah Transaksi</button>
                                </div>
                            </div>    

                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" name="harga" id="harga" class="form-control" onkeys="sum()" readonly="">
                                </div>

                                <div class="form-group">
                                    <label for="Jumlah">Jumlah</label>
                                    <input type="number" name="Jumlah" id="Jumlah" class="form-control" onkeyup="sum()" required="">
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
           <div class ="row">
            <div class="col-lg-12">
            <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                                    <th><div align="center">No</div></th>
                                                    <th><div align="center">Nama Pelanggan</div></th>
                                                    <th><div align="center">Nama Barang</div></th>
                                                    <th><div align="center">Harga</div></th>
                                                    <th><div align="center">Jumlah</div></th>
                                                    <th><div align="center">Sub Total</div></th>
                                                    <th><div align="center">Aksi</div></th>
                                                </tr>
                                            </thead>
 
                                            <?php $no = 1; ?>
                                            <?php $total = 0; ?>
                                            <?php foreach ($transaksi as $row) : ?>
                                            
                                            <?php $subtotal = $row['harga'] * $row['Jumlah']; ?>
                                            <?php $total = $total + $subtotal; ?>

                                            <tr>
                                                <td align="center"><?php echo $no; ?></td>
                                                <td align="center"><?php echo $row["nama_pelanggan"]; ?> </td>
                                                <td align="center"><?php echo $row["nama_barang"]; ?></td>
                                                <td align="center"><?php echo rupiah ($row["harga"]) ?></td>
                                                <td align="center"><?php echo $row["Jumlah"]; ?></td>
                                                <td align="center"><?php echo rupiah ($subtotal) ?></td>
                                                <td align="center"> 
                                                    <a href="transaksi_hapus.php?kode_jual=<?php echo $row["kode_jual"]; ?>" 
                                                    onclick="return confirm('Hapus Data Transaksi');">
                                                    <button class="btn btn-warning">
                                                        <i class="fa fa-trash"></i>Hapus
                                                    </button> 
                                                </a> 
                                            </td>
                                            </tr>

                                            <?php $no++; ?>
                                            <?php endforeach; ?>

                                            <?php 
                                            $sql=mysqli_query($koneksi, "SELECT * FROM keranjang WHERE kode_user = '$_SESSION[kode_user]'");
                                            $ketemu = mysqli_num_rows($sql);

                                            if($ketemu === 0){
                                                echo "<tr>
                                                <td colspan ='7' align='center'>
                                                <strong>Tidak ada data</strong> 
                                                </td>
                                                </tr>";
                                            }
                                                ?>

                                                <tr>
                                                    <td colspan="5" align = "center" class="total">
                                                        <strong>Total Harga </strong>
                                            </td>
                                            <td colspan="2" align = "center" class="total">
                                                        <strong><?php echo rupiah($total) ?></strong>
                                            </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                                            <?php 
                                            $sql = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE kode_user = '$_SESSION[kode_user]'");
                                            $ketemu = mysqli_num_rows($sql);

                                            if ($ketemu === 0){
                                                echo "";
                                            } else {
                                                echo "<a href = 'transaksi_aksi.php'>
                                                <button type = 'submit' name='transaksi_simpan' class = 'btn btn-primary'><i class = 'fa fa-plus fa-fw'></i> Simpan Transaksi
                                                </button>
                                                </a>";
                                            }
                                            ?>
                            </div>
                            </div>
                            </div>
            </div>
	  <!-- /#wrapper -->
        
        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>

        <script type="text/javascript">
            <?php echo $jsArray; ?>
            function changeValue(id){
                document.getElementById('harga').value = prdName[id].harga;
            }
            </script>
    </body>
	
</html>
