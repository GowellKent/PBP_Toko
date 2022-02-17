<!DOCTYPE html>
<html lang="en">

<head>
	<title>Input Barang</title>
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
	<div class="container rounded" style="margin-top:150px; background-color: #FFFFFF; padding-top:50px; padding-bottom:50px;">
	<?php
		require_once "func.php";

			if (isset($_POST['tambah'])) {
				$tambah_data['id_barang'] = isset($_POST['id_barang']) ? $_POST['id_barang'] : "";
				$tambah_data['nama_barang'] = isset($_POST['nama_barang']) ? $_POST['nama_barang'] : "";
				$tambah_data['harga'] = isset($_POST['harga']) ? $_POST['harga'] : "";
				$tambah_data['stok'] = isset($_POST['stok']) ? $_POST['stok'] : "";
				$tambah_data['id_supplier'] = isset($_POST['id_supplier']) ? $_POST['id_supplier'] : "";

				if ($tambah_data['id_barang'] == "" || $tambah_data['nama_barang'] == "" || $tambah_data['harga'] == "" || $tambah_data['stok'] == "" ||$tambah_data['id_supplier'] == "") {
					echo '<div class="alert alert-danger">Pastikan semua kolom sudah diisi!</div>';
				} else {
					$data = select_data($tambah_data['id_barang']);
					if (sizeof($data) > 0) {
						echo '<div class="alert alert-danger">Barang ('.$tambah_data['id_barang'].') sudah terdaftar!</div>';
					} else {
						if (insert_data($tambah_data)) echo '<div class="alert alert-success">Sukses tambah data Barang!</div>';
                        else echo '<div class="alert alert-danger">Gagal tambah data barang!</div>';
					}
				}
			}

			echo '
				<form method="post">
					<table class="table table-bordered text-monospace text-light">
						<tr>
							<th style="background-color: #007291;" width="15%" nowrap>Kode Barang</th>
							<td><input class="form-control" type="text" name="id_barang" required></td>
						</tr>
						<tr>
							<th style="background-color: #007291;">Nama Barang</th>
							<td><input class="form-control" type="text" name="nama_barang" required></td>
						</tr>
						<tr>
							<th style="background-color: #007291;">Harga</th>
							<td><input class="form-control" type="text" name="harga" required></td>
						</tr>
						<tr>
							<th style="background-color: #007291;">Stok</th>
							<td><input class="form-control" type="text" name="stok" required></td>
						</tr>
						<tr>
							<th style="background-color: #007291;">ID Supplier</th>
							<td><input class="form-control" type="text" name="id_supplier" required></td>
						</tr>
						<tr align="right">
							<td colspan="2"><input class="btn btn-success text-monospace" type="submit" name="tambah" value="TAMBAH"></td>
						</tr>
					</table>
				</form>
			';
	?>
	</div>
</body>

</html>