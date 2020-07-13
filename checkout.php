<?php
    session_start();
    require 'connDB.php';
    require 'itemCart.php';

    //Mengambil idPembeli
    $username = $_SESSION["username"];
    $sql = "SELECT * FROM pembeli WHERE username='$username'";
    $query = mysqli_query($conn, $sql);
    $r = mysqli_fetch_array($query);    
    $idPembeli = $r['idPembeli'];

    //Insert record Penjualan
    $sql = "INSERT INTO penjualan (idPembeli)
            VALUES ('".$idPembeli."')";
    if (mysqli_query($conn, $sql)) {
        // Get last insert id 
        $idPenjualan = mysqli_insert_id($conn);
        echo "Record updated successfully";        
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    $cart = unserialize(serialize($_SESSION['cart']));
    for($i=0; $i<count($cart); $i++){

        $kodebrg=$cart[$i]->id;
        $harga=$cart[$i]->price;
        $jumlah=$cart[$i]->quantity;
        
        $sql = "SELECT * FROM barang WHERE kodebrg='$kodebrg'";
        $query = mysqli_query($conn, $sql);
        $r = mysqli_fetch_array($query);    
        $oldStok = $r['stok'];
        $newStok = $oldStok - $jumlah;

        $sql = "INSERT INTO jual (idPenjualan, kodebrg, harga, jumlah)
            VALUES ('$idPenjualan','$kodebrg','$harga','$jumlah')";

        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        } 
        
        //Update stok barang
        $sql = "UPDATE barang SET stok='$newStok' WHERE kodebrg='$kodebrg'";

        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }    
    }
    mysqli_close($conn);
    if ($_SESSION["username"] == NULL) {
        header("location:login.php");
        
    } else {
        header("location:template.php?content=orderDetail.php");
    }

?>