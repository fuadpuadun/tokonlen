<?php
    require 'connDB.php';
	require 'itemCart.php';
	
	if(!isset($_SESSION['cart'])){
		header("location:template.php");
	}

    $username = $_SESSION["username"];
    $sql = "SELECT * FROM pembeli WHERE username='$username'";
    $query = mysqli_query($conn, $sql);
    $r = mysqli_fetch_array($query);
    $pembeli = $r['nama'];
    $alamat = $r['alamat'];
    $hp = $r['hp'];
    $kodepos = $r['kodepos'];    

	$totHargaBrg=0;
    $totBerat = 0;
    $roundBerat = 0;
    $tarif = 0;
?>
<div class="container">
	<h1>Detail Pesanan</h1>
	<hr>
	<form action="template.php?content=search.php" method="post" >
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
				$cart = unserialize(serialize($_SESSION['cart']));
				for($i=0; $i<count($cart); $i++){
					$totHargaBrg += $cart[$i]->price * $cart[$i]->quantity;
					$totBerat += $cart[$i]->quantity * $cart[$i]->weight;
			?>
			<tbody> 
				<tr>
						<td> <?php echo $cart[$i]->id; ?></td>
						<td> <?php echo $cart[$i]->name; ?></td>
						<td>Rp. <?php echo $cart[$i]->price; ?></td>
						<td><?php echo $cart[$i]->weight; ?> kg</td>
						<td> <?php echo $cart[$i]->quantity; ?></td>  
						<td>Rp. <?php echo $cart[$i]->price * $cart[$i]->quantity; ?></td>
						<td><?php echo $cart[$i]->weight * $cart[$i]->quantity; ?> kg</td>  
				</tr>
			</tbody>
			<?php }
				//Menghitung ongkir
				$sql = "SELECT * FROM ongkir WHERE kodePosTujuan='$kodepos'";
				$query = mysqli_query($conn, $sql);
				$r = mysqli_fetch_array($query);
				$tarif = $r['tarif'];
			
				if(fmod($totBerat,1) < 0.31){
					$roundBerat = floor($totBerat);
				} else {
					$roundBerat = ceil($totBerat);
				}
				if($roundBerat == 0){
					$roundBerat=1;
				}
				
				$totTarif = $tarif * $roundBerat;
			?>
			<tfoot>
				<tr>
					<td colspan="5" style="text-align:right; font-weight:bold">Total
					</td>
					<td>Rp. <?php echo $totHargaBrg; ?></td>
					<td><?php echo $totBerat; ?> kg</td>
				</tr>
			</tfoot>
		</table>
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
					<td>: 28125</td>
				</tr>
				<tr>
					<td><label>Kode Pos Tujuan</label></td>
					<td>: <?php echo $kodepos?></td>
				</tr>
				<tr>
					<td><label>Berat (kg)</label></td>
					<td>: <?php echo $totBerat?> kg</td>
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
		<div class="text-center">
			<button type="submit" class="btn btn-primary">Selesai</button>
		</div>
	</form>
</div>
<?php unset($_SESSION['cart']);?>