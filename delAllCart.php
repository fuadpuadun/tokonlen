<?php 
    session_start();

    $cart = unserialize(serialize($_SESSION['cart']));
    unset($_SESSION['cart']);
    header("location:template.php?content=shoppingcart.php");
 ?>