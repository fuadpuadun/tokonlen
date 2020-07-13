<?php
session_start();
require 'connDB.php';

$nama = $_POST["pembeli"];
$alamat = $_POST["alamat"];
$kodepos = $_POST["kodepos"];
$hp = $_POST["hp"];
$username = $_POST["username"];
$password = md5($_POST["password"]);

$sql = "INSERT INTO pembeli (username,password,nama, alamat, hp, kodePos)
            VALUES ('".$username."','".$password."','".$nama."','".$alamat."','".$hp."','".$kodepos."')";
if (mysqli_query($conn, $sql)) {
    header("location:login.php");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
