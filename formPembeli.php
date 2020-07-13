<div class="container">
    <h1>Formulir Pembelian Barang</h1>
    <hr>
    <form action="simpanPembeli.php" method="post" >
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
                                <option value="29411">
                                <option value="35115">
                                <option value="40111">
                                <option value="44111">
                            </datalist>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nomor hp</label>
            <div class="col-sm-10">
                <input type="text" name="hp" required="required" class="form-control" placeholder="masukkan nomor hp anda">
            </div>
        </div>
        <div class="d-flex justify-content-sm-between">
            <a href="template.php?content=<?php echo 'shoppingcart.php'?>" class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali</a>
            <button type="submit" class="btn btn-success">Simpan <i class="fa fa-angle-right"></i></button>
        </div>
    </form>
</div>