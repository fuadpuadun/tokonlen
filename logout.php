<?php
    session_start();
    session_destroy(); // Hapus semua session
    header("location: template.php");
?>