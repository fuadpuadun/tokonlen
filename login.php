<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="fontawesome/js/all.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card my-5">
                    <div class="card-body">
                        <h3 class="card-title text-center">Selamat Datang</h3>
                        <hr>
                        <!-- cek pesan notifikasi -->
                        <?php 
                        require 'connDB.php';
                        if(isset($_GET['pesan'])){
                            if($_GET['pesan'] == "gagal"){
                                echo '<p class="text-danger text-center">login gagal</p>';
                            }
                        }
                        ?>
                        <form action="ceklogin.php" method="post" >
                            <!--Username-->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    </div>
                                    <input name="username" class="form-control" placeholder="username" type="text">
                                </div>
                            </div>
                            <!--Password-->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                    </div>
                                    <input name="password" class="form-control" placeholder="password" type="password">
                                </div>
                            </div>
                            <!--login-->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                            </div>
                        </form>
                        <p class="text-center">Belum punya akun? <a href="register.php">Daftar</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>