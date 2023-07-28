
<?php
require 'functions.php';

if (isset($_POST["register"])){
    if(register($_POST) > 0){
        echo "
        <script>
        alert ('User baru berhasil ditambahkan');
        document.location.href = 'login.php';
        </script>
        ";
    } else {
        echo mysqli_error($koneksi);
    }
}
$query = mysqli_query ($koneksi, "SELECT MAX(kode_user) as kodeTerbesar FROM user");
$data = mysqli_fetch_array($query);
$kodeUser = $data['kodeTerbesar'];
$urutan = (int) substr($kodeUser , 3, 3);
$urutan++;

$huruf = "USR";
$kodeUser = $huruf . sprintf("%03s", $urutan);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Aplikasi Penjualan Kaca Film 3M AUTOFILM LUMINER</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <style type="texs/css">
            .panel-body a{
                text-decoration : none;
                font-weight: bold;
            }
            </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">FORM REGISTER</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form"method="post">
                                <fieldset>
                                    <div class="form-group">
                                        <label id="kode_user">Kode User</label>
                                        <input class="form-control" placeholder="Kode User" name="kode_user" id="kode_user" type="text" 
                                        value="<?php echo $kodeUser; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label id="nama_user">Nama User</label>
                                        <input class="form-control" placeholder="Nama User" name="nama_user" id="nama_user" type="text" 
                                        autofocus="" autocomplete="off" required="">
                                    </div>
                                    <div class="form-group">
                                        <label id="nama_user">Username</label>
                                        <input class="form-control" placeholder="Username" name="username" id="username" type="text" 
                                        autofocus="" autocomplete="off" required="">
                                    </div>
                                    <div class="form-group">
                                        <label id="nama_user">Password</label>
                                        <input class="form-control" placeholder="Password" name="password" id="password" type="password" 
                                        autofocus="" autocomplete="off" required="">
                                    </div>
                                    <div class="form-group">
                                        <label id="nama_user">Konfirmasi Password</label>
                                        <input class="form-control" placeholder="Konfirmasi Password" name="password2" id="password2" type="password" 
                                        autofocus="" autocomplete="off" required="">
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button class="btn btn-lg btn-primary btn-block" name="register"><B>REGISTER</B></button>

                                    <div>
                                        <span>Sudah punya akun? <a href="login.php">LOGIN DISINI</a></span>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
