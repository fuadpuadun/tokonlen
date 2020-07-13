<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/warungCovid.css">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.bundle.js"></script>
        <script src="fontawesome/js/all.js"></script>
        <title>GudangGimang</title>
    </head>
    <body>
        <?php
            session_start();
            //Untuk connect ke DB tanpa harus inisiasi setiap code
            require 'connDB.php';

            //display konten
            if(!isset($_GET['content'])) {
                $vcontent = 'search.php';
            } else{
                $vcontent = $_GET ['content'];
            }
        ?>
        <!-- Navigation Bar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand mb-0 h1" href="#">GudangGimang</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="template.php?content=<?php echo 'search.php'?>">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="template.php?content=<?php echo 'shoppingcart.php'?>">Shopping Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="template.php?content=<?php echo 'admin.php'?>">Admin</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="login.php">Login</a>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Content -->
        <div class= "bg-secondary">
            <br>
                <?php include $vcontent; ?>
            <br>
        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container-fluid">
            <p class="m-0 text-center text-white">Copyright &copy; GudangGimang 2020</p>
            </div>
        </footer>
    </body>
</html>