<?php 

require 'config.php';
require 'item.php';
//Simpan pesanan baru
$kasir = $_SESSION['user'];
$sql1 = 'INSERT INTO orders (name, datecreation, status, user) VALUES ("New Order",now(),0,"'.$kasir.'")';
mysqli_query($conn, $sql1);
$ordersid = mysqli_insert_id($conn); 
$cart = unserialize(serialize($_SESSION['cart'])); //Set $cart sebagai array, serialize () mengubah string menjadi array
for($i=0; $i<count($cart);$i++) {
$sql2 = 'INSERT INTO orderdetail (productid, orderid, price, quantity) VALUES ('.$cart[$i]->id.', '.$ordersid.', '.$cart[$i]->price.', '.$cart[$i]->quantity.')';
mysqli_query($conn, $sql2);
}
//Menghapus semua produk dalam keranjang
unset($_SESSION['cart']);
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Detail Transaksi</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="templates/bootstrap.min.css">
	<script src="templates/jquery.min.js"></script>
	<script src="templates/popper.min.js"></script>
	<script src="templates/bootstrap.min.js"></script>
</head>
<body style="background-color: #f0f0f0;">
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #007291;"> 
		<a class="navbar-brand" href="index_kasir.php">PANEL KASIR</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"> 
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container text-monospace rounded" style="margin-top:150px; background-color: #ffffff; text-align: center; padding-bottom: 15px;">
    <?php
    require_once "func.php";

			if (!isset($_SESSION['user'])) {
				header("Location: login.php");
			} else {

				$id = isset($_GET['id_barang']) ? $_GET['id_barang'] : "";
				$data_table = '';
				$total = 0;
				$data = order_detail($ordersid);
				foreach ($data as $key => $val) {
					$data_table .= '
						<tr>
							
							<td>'.$val['productid'].'</td>
							<td><center>'.$val['price'].'</center></td>
							<td><center>'.$val['quantity'].'</center></td>
						</tr>
					';
					$total += $val['price']*$val['quantity'];
				}
	
				if ($data_table == "") {
					$data_table = '<tr class="table-danger"><th colspan="4"><center>NO DATA</center></th></tr>';
				}
	
				echo '
				<h3 style="padding-top:15px;">Kode Transaksi : '.$ordersid.'</h3>
				<form method="post" action="detail_trans.php?id='.$ordersid.'">
					<table class="table table-bordered table-hover text-monospace" style="width: 50%; margin: auto;" id="tabel">
						<tr class="header text-light"  style="background-color: #007291;"scope="col">
							<th nowrap><center>Kode Barang</center></th>
							<th nowrap><center>Harga</center></th>
							<th nowrap><center>Jumlah</center></th>
						</tr>
						'.$data_table.'
						<tr align="center">
							<th><center>Total :</center></th>
							<td colspan="2">'.$total.'</td>
						</tr>
						<tr align="right">
							<td colspan="3"><a class="btn btn-success" href="index_kasir.php">Kembali</a></td>
						</tr>
					</table>
					</form>
				';
			}
    ?>
    
    </div>
</body>