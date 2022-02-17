<!DOCTYPE html>
<html lang="en">

<head>
	<title>Data Barang</title>
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
	
	<div class="container" style="margin-top:50px;">
		<div class="row">
			<div class="col-3 text-monospace">
				<h3 align="left">Cari ID &nbsp;&nbsp;:</h3>
			</div>
			<div class="col-9 text-monospace">
				<input type="text" id="searchid" onkeyup="cari_id()" name="keyid" placeholder="Cari ID barang..">
			</div>
		</div>

		<div class="row">
			<div class="col-3 text-monospace">
			<h3 align="left">Cari Nama :</h3>
			</div>
			<div class="col-9 text-monospace">
			<input type="text" id="searchnama" onkeyup="cari_nama()" name="keyname" placeholder="Cari Nama barang..">
			</div>
		</div>
		
	</div>
			
	<div class="container rounded" style="margin-top:50px; background-color: #ffffff; padding-top:15px; padding-bottom: 15px;">
	<?php
		require_once "func.php";

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
						<td><center><a class="btn btn-outline-danger" href="data_barang.php?hapus='.$val['id_barang'].'&nama='.$val['nama_barang'].'">Hapus <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
						<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
						<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
					  </svg></a><center></td>
					</tr>
				';
			}

			if ($data_table == "") {
				$data_table = '<tr class="table-danger"><th colspan="4"><center>NO DATA</center></th></tr>';
			}

			echo '
			<form method="post">
				<table class="table table-bordered table-hover text-monospace" id="tabel" #007291>
					<tr class="header text-light" scope="col" style="background-color: #007291;">
						<th width="10%" nowrap><center>Kode Barang</center></th>
						<th nowrap><center>Nama Barang</center></th>
						<th width="15%" nowrap><center>Harga</center></th>
						<th width="10%" nowrap><center>Stok</center></th>
						<th width="15%"><center>Supplier ID<center></th>
						<th width="15%"><center>Hapus<center></th>
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

			$hapus = isset($_GET['hapus']) ? $_GET['hapus'] : "";
			if ($hapus != "") {
				
				$data = select_data($hapus);
				if (sizeof($data) > 0) {
					if (delete_data($hapus)) echo '<div style="text-align: center;" class=" alert alert-success"><center>Sukses hapus</center> '.$nama.'!</div>';
					else echo '<div style="text-align: center;" class="alert alert-danger">Gagal hapus '.$nama.'!</div>';
					header("Refresh:1; url=data_barang.php");
				}
		} }
	?>
	</div>
</body>

</html>