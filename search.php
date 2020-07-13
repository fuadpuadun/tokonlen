<div class="container">
    <h1>Jualan yang Ready</h1>
    <hr>
    <!--Search bar-->
    <form method="post">
        <div class="input-group mb-4 border rounded-pill p-1">
            <input name="kodebrg" type="text" placeholder="Cari apa bro?" class="form-control bg-none border-0 font-italic">
            <div class="input-group-append border-0">
              <button name="submit" id="button-addon3" type="submit" class="btn btn-link text-success"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
    
    <div class="row">
        
        <?php //Semua barang
        require 'connDB.php';

        if(!ISSET($_POST['submit'])){
            $sql = "SELECT * FROM barang";
            $query = mysqli_query($conn, $sql);
            while ($r = mysqli_fetch_array($query)){
        ?>
        <div class="col-12 col-sm-8 col-md-6 col-lg-3 d-flex bg-secondary">
            <div class="card mb-4">
                <img width="150" height="200" class="card-img" src="fotobarang/<?= $r['fileGambar']; ?>">
                <div class="card-body">
                    <h4 class="card-title text-info"><?php echo $r['namabrg']; ?></h4>
                    <h6 class="card-subtitle mb-2 text-muted">Stok : <?php echo $r['stok']; ?></h6>
                </div>
                <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
                    <div class="price text-success"><h5 class="mt-4">Rp. <?php echo $r['harga']; ?></h5></div>
                    <a href="template.php?content=<?php echo 'shoppingcart.php'?>&kodebrg=<?php echo $r["kodebrg"];?>" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to cart</a>
                </div>
            </div>
        </div>
        <?php } } ?>

        <?php //Cari barang
        if (ISSET($_POST['submit'])){
            $cari = $_POST['kodebrg'];
            $query2 = "SELECT * FROM barang WHERE namabrg LIKE '%$cari%'";
            $sql = mysqli_query($conn, $query2);
            while ($r = mysqli_fetch_array($sql)){
        ?>
        <div class="col-12 col-sm-8 col-md-6 col-lg-3 d-flex bg-secondary">
            <div class="card mb-4">
                <img width="150" height="200" class="card-img" src="fotobarang/<?= $r['fileGambar']; ?>">
                <div class="card-body">
                    <h4 class="card-title text-info"><?php echo $r['namabrg']; ?></h4>
                    <h6 class="card-subtitle mb-2 text-muted">Stok : <?php echo $r['stok']; ?></h6>
                </div>
                <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
                    <div class="price text-success"><h5 class="mt-4">Rp. <?php echo $r['harga']; ?></h5></div>
                    <a href="template.php?content=<?php echo 'shoppingcart.php'?>&kodebrg=<?php echo $r["kodebrg"];?>" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                </div>
            </div>
        </div>
        <?php }} ?>
    </div>
</div>