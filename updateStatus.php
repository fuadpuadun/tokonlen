<?php
    require 'connDB.php';

    $idPenjualan = $_GET['idPenjualan'];
    $status = $_GET['status'];
    $sql = "UPDATE penjualan SET status='$status' WHERE idPenjualan='$idPenjualan'";

        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    mysqli_close($conn);
    header("location:template.php?content=admin.php");
?>