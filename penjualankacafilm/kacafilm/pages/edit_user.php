<?php
session_start();

if (!isset($_SESSION["login"])){
    header("Location:login.php");
    exit;    
}

require 'functions.php';

$nama_user=query("SELECT * FROM user WHERE kode_user = '$_SESSION[kode_user]' ");

if (isset($_POST["edit_user"])){
    if (edituser($_POST) > 0){
        echo "
        <script>
        alert('Data User Berhasil Diedit');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "
        <script>
        alert('Data User Gagal Diedit');
        document.location.href = 'index.php';
        </script>";
    }
}
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
                    <form method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><i class="fa fa-home fa-fw"></i>Edit User</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                        
                        <?php foreach ($nama_user as $user ) : ?>
                           

                        <div class ="form-group">
                            <label for ="kode_user">Kode User</label>
                            <input type="text" name="kode_user" class="form-control" id="kode_user" value="<?php echo $user["kode_user"] ?>" readonly="">
                         </div>

                        <div class ="form-group">
                            <label for ="nama_user">Nama User</label>
                            <input type="text" name="nama_user" class="form-control" id="nama_user" value="<?php echo $user["nama_user"] ?>" required="" autofocus="" autocomplete="off">
                        </div>

                        <div class ="form-group">
                            <label for ="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" value="<?php echo $user["username"] ?>" required="" autofocus="" autocomplete="off">
                        </div>
                    
                        <button type="submit" class="btn btn-primary" name="edit_user">Edit</button>

                        <?php endforeach ?>
                            </div>
                    
                            </form>
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
    </body>
	
</html>
