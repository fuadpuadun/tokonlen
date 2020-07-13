<?php 
    require 'connDB.php';
    session_start();

    if (isset($_POST["username"])) {
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];
    }
            
    $username = $_SESSION["username"];
    $password = md5($_SESSION["password"]);
            
    $query = "SELECT * FROM pembeli WHERE username='$username' AND password='$password'";
    $cek = $conn->query($query);
    if($cek ->num_rows > 0) {
        $_SESSION["username"] = $username;
        $r = mysqli_fetch_array($cek);    
        $nama = $r['nama'];
        header("location:template.php");
    }else{
        header("location:login.php?pesan=gagal");
    }
?>