<?php
    require 'connDB.php';
    $sql = "SELECT * FROM penjualan INNER JOIN pembeli ON penjualan.idPembeli=pembeli.idPembeli";
?>
<div class="container">
    <h1>History Penjualan</h1>
    <hr>
    
    <table class="table table-hover table-responsive-sm">
    <thead>
        <tr>
            <th>ID Penjualan</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>HP</th>
            <th>Kodepos</th>
            <th>Tanggal Transaksi</th>
            <th>Detail</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <?php
    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $idPenjualan = $row["idPenjualan"];
            $idPembeli = $row["idPembeli"];
            $pembeli = $row["nama"];
            $alamat = $row["alamat"];
            $hp = $row["hp"];
            $kodepos = $row["kodepos"];
            $tglTransaksi = $row["tglTransaksi"];
            $status = $row["status"];
            ?>
            <tbody>
                <tr> 
                    <td><?php echo $idPenjualan?></td> 
                    <td><?php echo $pembeli?></td> 
                    <td><?php echo $alamat?></td> 
                    <td><?php echo $hp?></td> 
                    <td><?php echo $kodepos?></td>
                    <td><?php echo $tglTransaksi?></td>
                    <td><a href="template.php?content=<?php echo 'detailPenjualan.php'?>&idPenjualan=<?php echo $idPenjualan;?>&idPembeli=<?php echo $idPembeli;?>" class="btn btn-primary"><i class="fas fa-eye"></i> Lihat</a></td>
                    <td>
                        <?php switch ($status) {
                            case '0':?>
                                <span class="badge badge-secondary">Belum bayar</span>
                            <?php break;
                            case '1':?>
                                <span class="badge badge-success">Sudah bayar</span>
                            <?php break;
                            case '2':?>
                                <span class="badge badge-warning">Sudah kirim</span>
                            <?php break;
                        }?>
                    </td>
                    <td>
                    <?php switch ($status) {
                            case '0':?>
                                <a href="updateStatus.php?idPenjualan=<?php echo $idPenjualan;?>&status=1" onclick="return confirm('Ubah status sudah bayar?')" class="btn btn-outline-success">Bayar</a> 
                            <?php break;
                            case '1':?>
                                <a href="updateStatus.php?idPenjualan=<?php echo $idPenjualan;?>&status=2" onclick="return confirm('Ubah status sudah kirim?')" class="btn btn-outline-warning">Kirim</a>
                            <?php break;
                            case '2':?>
                                <button type="button" class="btn btn-secondary" disabled><i class="fas fa-check"></i> Selesai</button>
                            <?php break;
                            }
                            ?>
                    </td> 
                </tr>
            </tbody>
            <?php
        }
        $result->free();
    } 
    ?>
    </table>
</div>
<hr>
<!--Import Excel-->
<button type="button" class="btn btn-success my-3" data-toggle="modal" data-target="#importExcel">
		Tambah Data Barang
	</button>

    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="importExcel.php" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    </div>
                    <div class="modal-body">

                        <label>Harus berformat excel !</label>
                        <div class="form-group">
                            <input type="file" name="berkas_excel" class="form-control" id="exampleInputFile" required="required">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<div class="btn">
    <form action="exportExcel.php" method="post">
            <button type="submit" id="exportExcel" name='exportExcel' value="Export to Excel" class="btn btn-info">Export to Excel</button>
    </form>
</div>