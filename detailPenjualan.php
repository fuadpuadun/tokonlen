<?php
    require 'connDB.php';
?>
<div class="container">
    <h1>Detail Penjualan</h1>
    <hr>
    <table class="table table-hover table-responsive-sm">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Berat</th>
                <th>Jumlah</th>
                <th>Sub Harga</th>
                <th>Sub Berat</th>
            </tr>
        </thead>
        <?php
            $idPenjualan = $_GET["idPenjualan"];
            $totHargaBrg=0;
            $totBeratBrg=0;
            $sql = "SELECT jual.kodebrg,jual.harga,jual.jumlah, barang.namabrg,barang.berat FROM jual INNER JOIN barang on jual.kodebrg = barang.kodebrg WHERE idPenjualan='$idPenjualan'";
            $query = mysqli_query($conn, $sql);
            while ($r = mysqli_fetch_array($query)){
        ?>
        <tbody> 
            <tr>
                <td><?php echo $r['kodebrg'];?></td>
                <td><?php echo $r['namabrg'];?></td>
                <td>Rp. <?php echo $r['harga'];?></td>
                <td><?php echo $r['berat'];?> kg</td>
                <td><?php echo $r['jumlah'];?></td>
                <?php $totBrg = $r['harga'] * $r['jumlah']; ?>
                <td>Rp. <?php echo $totBrg;?></td>
                <?php $totBrt = $r['berat'] * $r['jumlah']; ?>
                <td><?php echo $totBrt;?> kg</td>
            </tr>
        </tbody>
        <?php 
            $totHargaBrg+=$totBrg;
            $totBeratBrg+=$totBrt;} 
        ?>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align:right; font-weight:bold">Total</td>
                <td>Rp. <?php echo $totHargaBrg; ?></td>
                <td><?php echo $totBeratBrg; ?> kg</td>
            </tr>
        </tfoot>
    </table>
    <?php
        //Identitas pembeli
        $idPembeli = $_GET["idPembeli"];
        $sql = "SELECT * FROM pembeli WHERE idPembeli='$idPembeli'";
        $query = mysqli_query($conn, $sql);
        $r = mysqli_fetch_array($query);
        $pembeli = $r['nama'];
        $alamat = $r['alamat'];
        $hp = $r['hp'];
        $kodepos = $r['kodepos'];

        //Menghitung ongkir
        $sql = "SELECT * FROM ongkir WHERE kodePosTujuan='$kodepos'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        $tarif = $row['tarif'];
        if(fmod($totBeratBrg,1) < 0.31){
            $roundBerat = floor($totBeratBrg);
        } else{
            $roundBerat = ceil($totBeratBrg);
        }
        if($roundBerat == 0){
            $roundBerat=1;
        }
        $totTarif = $tarif * $roundBerat;
    ?>
    <div class="d-flex justify-content-center">
        <table>
            <tr>		
                <td><label>Nama</label></td>
                <td>: <?php echo $pembeli?></td>
            </tr>
            <tr>
                <td><label>Alamat</label></td>
                <td>: <?php echo $alamat?></td>
            </tr>
            <tr>
                <td><label>No HP</label></td>
                <td>: <?php echo $hp?></td>
            </tr>
            <tr>
                <td><label>Kode Pos Awal</label></td>
                <td>: 41313</td>
            </tr>
            <tr>
                <td><label>Kode Pos Tujuan</label></td>
                <td>: <?php echo $kodepos?></td>
            </tr>
            <tr>
                <td><label>Berat (kg)</label></td>
                <td>: <?php echo $totBeratBrg?> kg</td>
            </tr>
            <tr>
                <td><label>Tarif pengiriman</label></td>
                <td>: Rp. <?php echo $totTarif?></td>
            </tr>
        </table>
    </div>
    <br>
    <h2> Total yang harus dibayar : Rp. <?php echo $totTarif+$totHargaBrg;?></h2>
    <br>
    <a href="template.php?content=<?php echo 'admin.php'?>" class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali</a>
</div>