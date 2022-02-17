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
<nav class="navbar navbar-expand-sm navbar-dark text-monospace" style="background-color: #007291;"> 
		<a class="navbar-brand" href="index.php">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
				<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
				<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
			</svg>
			ADMIN PANEL
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav">
				<li class="nav-item"> 
					<a class="nav-link" href="data_barang.php">Data Barang</a>
				</li>
				&nbsp;
				<li class="nav-item"> 
					<a class="nav-link" href="data_supp.php">Data Supplier</a>
				</li>
				&nbsp;
				<li class="nav-item"> 
					<a class="nav-link" href="input_barang.php">Input</a>
				</li>
				&nbsp;
				<li class="nav-item"> 
					<a class="nav-link" href="riwayat_beli.php">Riwayat Transaksi</a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"> 
					<a class="nav-link" href="logout.php">Logout
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
							<path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
						</svg>
					</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container text-monospace rounded" style="margin-top:150px; background-color: #ffffff; text-align: center;">
    <?php
    require_once "func.php";

			if (!isset($_SESSION['user'])) {
				header("Location: login.php");
			} else {

				$id = isset($_GET['id_barang']) ? $_GET['id_barang'] : "";
				$data_table = '';
				$total = 0;
				$data = order_detail($id);
				foreach ($data as $key => $val) {
					$data_table .= '
						<tr>
							
							<td><center>'.$val['productid'].'</center></td>
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
				<h3 style="padding-top:15px;">Kode Transaksi : '.$id.'</h3>
				<form method="post" action="detail_trans.php?id='.$id.'">
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
							<td colspan="3"><a class="btn btn-success" href="riwayat_beli.php">Kembali</a></td>
						</tr>
					</table>
					<br/>
					</form>
				';
			}
    ?>
    
    </div>
</body>