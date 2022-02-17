<!DOCTYPE html>
<html lang="en">

<head>
	<title>Index Kasir</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="templates/bootstrap.min.css">
	<script src="templates/jquery.min.js"></script>
	<script src="templates/popper.min.js"></script>
	<script src="templates/bootstrap.min.js"></script>
	<script src="searchbar.js" type="text/javascript"></script>
	<style>
		#searchnama, #searchid {
		width: 100%; /* Full-width */
		font-size: 16px; /* Increase font-size */
		padding: 12px 20px 12px 40px; /* Add some padding */
		border: 1px solid #ddd; /* Add a grey border */
		margin-bottom: 12px; /* Add some space below the input */
	}
	</style>
</head>

<body style="background-color: #f0f0f0;" class="text-monospace">
	<nav class="navbar navbar-expand-sm navbar-dark text-monospace" style="background-color: #007291;"> 
		<a class="navbar-brand" href="index_kasir.php">PANEL KASIR</a>&nbsp;&nbsp;
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav">
				<li class="nav-item"> 
					<a class="nav-link" href="cart.php">keranjang
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
							<path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
						</svg>
					</a>
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

	<div class="pt-5">
		<?php
			require_once "func.php";

			echo '<h1><center>Selamat Datang, '.$_SESSION['user'].'</center></h1>';
		?>
	</div>
	
	<div class="container" style="margin-top:50px;">
		<div class="row">
			<div class="col-3">
				<h3 align="left">Cari ID &nbsp;&nbsp;:</h3>
			</div>
			<div class="col-9">
				<input type="text" id="searchid" onkeyup="cari_id()" placeholder="Cari ID barang..">
			</div>
		</div>

		<div class="row">
			<div class="col-3">
			<h3 align="left">Cari Nama :</h3>
			</div>
			<div class="col-9">
			<input type="text" id="searchnama" onkeyup="cari_nama()" placeholder="Cari Nama barang..">
			</div>
		</div>
		
	</div>
			
	<div class="container rounded" style="margin-top:50px; background-color: #ffffff; padding-top:20px; padding-bottom:10px;">
	<?php

		if (!isset($_SESSION['user'])) {
			header("Location: login.php");
		} else {
			$data_table = '';
			$data = select_data();
			foreach ($data as $key => $val) {
				$data_table .= '
					<tr>
						<td><center><a href="cari_barang.php?id_barang='.$val['id_barang'].'">'.$val['id_barang'].'</center></td>
						<td>'.$val['nama_barang'].'</td>
						<td><center>'.$val['harga'].'</center></td>
						<td><center>'.$val['stok'].'</center></td>
						<td><center>'.$val['supp'].'<center></td>
						<td><center><a class="btn btn-outline-success" href="cart.php?idb='.$val['id_barang'].' &action=add">Tambah 
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z"/>
							</svg>
						</a><center>
						</td>
				';
			}

			if ($data_table == "") {
				$data_table = '<tr class="table-danger"><th colspan="4"><center>NO DATA</center></th></tr>';
			}

			echo '
			<form method="post">
				<table class="table table-bordered table-hover" id="tabel">
					<tr class="header text-light" scope="col" style="background-color: #007291;" >
						<th width="15%" nowrap><center>Kode Barang</center></th>
						<th nowrap><center>Nama Barang</center></th>
						<th width="15%" nowrap><center>Harga</center></th>
						<th width="15%" nowrap><center>Stok</center></th>
						<th width="15%"><center>Supplier ID<center></th>
						<th width="15%"><center>Tambah<center></th>
					</tr>
					'.$data_table.'
				</table>
				</form>
			';
		}

		if (!isset($_SESSION['user'])) {
			header("Location: login.php");
		} else {
			$nama = isset($_GET['nama_barang']) ? $_GET['nama_barang'] : "";
			$harga = isset($_GET['harga']) ? $_GET['harga'] : "";
			$add = isset($_GET['add']) ? $_GET['add'] : "";
			if ($add != "") {
				
				$data = select_data($add);
				if (sizeof($data) > 0) {
					if (additem($add,$nama,$harga)) echo '<div style="text-align: center;" class=" alert alert-success"><center>Sukses hapus</center> '.$nama.'!</div>';
					else echo '<div style="text-align: center;" class="alert alert-danger">Gagal hapus '.$nama.'!</div>';
					header("Refresh:1; url=data_barang.php");
				}
			} 	
		}

		
	?>
	</div>
</body>

</html>