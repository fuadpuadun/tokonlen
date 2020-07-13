<?php
    require 'connDB.php';
    require 'itemCart.php';

    //jika tidak ada session cart, maka akan dibuat
    if(!isset($_SESSION['cart'])){
        $item = new Item();
        $_SESSION['cart'][] = $item;
        $cart = unserialize(serialize($_SESSION['cart']));
        unset($cart[0]);
        $cart = array_values($cart);
        $_SESSION['cart'] = $cart;
    }
    //Menambahkan produk ke cart
    if(isset($_GET['kodebrg']) && !isset($_POST['update'])){
        $kodebrg = $_GET["kodebrg"];
        $sql = "SELECT * FROM barang WHERE kodebrg='$kodebrg'";
        $query = mysqli_query($conn, $sql);
        $r = mysqli_fetch_array($query);
        //Mengisi kedalam variabel
        $item = new Item();
        $item->id = $r['kodebrg'];
        $item->name = $r['namabrg'];
        $item->price = $r['harga'];
        $item->stock = $r['stok'];
        $item->weight = $r['berat'];
        $item->image = $r['fileGambar'];
        $item->quantity = 1;
        //Periksa produk dalam keranjang
        $index = -1;
        $cart = unserialize(serialize($_SESSION['cart']));
        for($i=0; $i<count($cart);$i++)
            if ($cart[$i]->id == $_GET['kodebrg']){
                $index = $i;
                break;
            }
            if($index == -1) 
                $_SESSION['cart'][] = $item; //$ _SESSION ['cart']: set $ cart sebagai variabel _session
            else {
                //Mengisi jumlah item cart
                if (($cart[$index]->quantity) < $item->stock)
                    $cart[$index]->quantity ++;
                    $_SESSION['cart'] = $cart;
            }
    }
    //Menghapus produk dalam keranjang
    if(isset($_GET['index']) && !isset($_POST['update'])) {
        $cart = unserialize(serialize($_SESSION['cart']));
        unset($cart[$_GET['index']]);
        $cart = array_values($cart);
        $_SESSION['cart'] = $cart;
    }
    //Perbarui jumlah dalam keranjang
    if(isset($_POST['update'])) {
        $arrQuantity = $_POST['quantity'];
        $cart = unserialize(serialize($_SESSION['cart']));
        for($i=0; $i<count($cart);$i++) {
            $cart[$i]->quantity = $arrQuantity[$i];
        }
        $_SESSION['cart'] = $cart;
    }
    //Redirect
    if(isset($_GET["index"])){
        header('Location: template.php?content=shoppingcart.php');
    } 
?>
<div class="container">
    <h1>Shopping cart</h1>
    <hr>
    <form method="POST">
        <table class="table table-responsive-sm">
            <thead>
                <tr>
                    <th style="width:10%">Hapus</th>
                    <th style="width:20%">Produk</th>
                    <th style="width:30%">Nama</th>
                    <th style="width:15%">Harga</th>
                    <th style="width:10%">Jumlah</th>
                    <th style="width:15%">Total</th>
                </tr>
            </thead>
            <?php 
                $cart = unserialize(serialize($_SESSION['cart']));
                $s = 0;
                $index = 0;
                for($i=0; $i<count($cart); $i++){
                    $s += $cart[$i]->price * $cart[$i]->quantity;
            ?> 
            <tbody>
                <tr>
                    <td><a href="template.php?content=<?php echo 'shoppingcart.php'?>&index=<?php echo $index; ?>" onclick="return confirm('Hapus barang?')" class="btn btn-danger btn-lg my-5"><i class="fa fa-trash"></i></a> </td>
                    <td><img src="fotobarang/<?=$cart[$i]->image;?>"class="img-fluid"></td>
                    <td> <h4 class="text-info"> <?php echo $cart[$i]->name; ?></h4> </td>
                    <td> <h6 class="text-secondary">Rp. <?php echo $cart[$i]->price; ?></h6> </td>
                    <td> <input type="number" min="0" max="<?php echo $cart[$i]->stock; ?>" value="<?php echo $cart[$i]->quantity; ?>" name="quantity[]"> </td>  
                    <td> <h6 class="text-secondary">Rp. <?php echo $cart[$i]->price * $cart[$i]->quantity; ?></h6> </td> 
                </tr>
            </tbody>
            <?php 
                $index++;
            } ?>
            <tfoot>
                <tr>
                    <td colspan="3"><a href="delAllCart.php" onclick="return confirm('Hapus semua barang dalam keranjang?')" >Bersihkan keranjang</a></td>
                    <td colspan="2" class="text-right font-weight-bold">Total</td>
                    <td class="font-weight-bold">Rp. <?php echo $s;?> 
                        <button class="btn btn-warning btn-sm" type="submit" name="update"><i class="fa fa-sync-alt"></i></button>
                        <input type="hidden" name="update">
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
    <!-- Fitur -->
    <div class="d-flex justify-content-sm-between">
        <a href="template.php?content=<?php echo 'search.php'?>" class="btn btn-primary"><i class="fa fa-angle-left"></i> Tambah produk</a>
        <a href="checkout.php" class="btn btn-success">Checkout <i class="fa fa-angle-right"></i></a>
    </div>
</div>