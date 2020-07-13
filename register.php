<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="fontawesome/js/all.js"></script>
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="col-sm-12 col-md-10 col-lg-8 mx-auto">
            <div class="card my-5">
                <div class="card-body">
                    <h3 class="card-title text-center">Pendaftaran akun</h3>
                    <hr>
                    <form action="simpanPembeli.php" method="post" oninput='password_Confirm.setCustomValidity(password_Confirm.value != password.value ? "Passwords do not match." : "")'>
                        <div class="form-group row">		
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="pembeli" required="required" class="form-control" placeholder="Nama lengkap">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" name="alamat" required="required" class="form-control" placeholder="Alamat pengiriman">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kode pos</label>
                            <div class="col-sm-10">
                                <input list="kodepos" name="kodepos" required="required" class="form-control" placeholder="masukkan kodepos anda">
                                            <datalist id="kodepos">
                                                <option value="28125">
                                                <option value="28126">
                                                <option value="28127">
                                                <option value="28128">
                                            </datalist>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nomor hp</label>
                            <div class="col-sm-10">
                                <input type="text" name="hp" required="required" class="form-control" placeholder="masukkan nomor hp anda">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">		
                            <label class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" required="required" class="form-control" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group row">		
                            <label class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" required="required" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">		
                            <label class="col-sm-2 col-form-label">Password Confirm</label>
                            <div class="col-sm-10">
                                <input type="password" id="password_Confirm" name="password_Confirm" required="required" class="form-control" placeholder="Confirm password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <button type="submit" class="btn btn-primary btn-block">Mendaftar</button>
                        </div>
                    </form>
                    <p class="text-center">Sudah punya akun? <a href="login.php">Masuk</a> </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>