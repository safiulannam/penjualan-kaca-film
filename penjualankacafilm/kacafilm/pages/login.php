<?php
session_start();
require 'functions.php';

if(isset($_SESSION["login"])){
    header("Location:index.php");
    exit;
}

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' ");

    //cek username
    if(mysqli_num_rows ($result) === 1) {

        //cek pasword
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])){
            
            //set session
            $_SESSION["login"]= true;
            $_SESSION["kode_user"] = $row["kode_user"];

            echo "<script>
            alert ('Kamu berhasil Login');
            document.location.href = 'index.php';
            </script>";
            exit;
        }
    }
    echo "<script>
            alert ('Kamu Gagal Login');
            document.location.href = 'login.php';
            </script>";

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
                            <h3 class="panel-title text-center">FORM LOGIN</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form"method="post">
                                <fieldset>
                                   
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

                                    <!-- Change this to a button or input when using this as a form -->
                                    <button class="btn btn-lg btn-primary btn-block" name="login"><B>LOGIN</B></button>

                                    <div>
                                        <span>Belum punya akun? <a href="register.php">REGISTER DISINI</a></span>
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
