<!DOCTYPE html>
<html lang="en">

<head>
	<title>Detail Barang</title>
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
	<div class="container rounded" style="margin-top:150px; background-color: #ffffff; padding-top:20px; padding-bottom: 20px;">
    <?php
    require_once "func.php";
    if (!isset($_SESSION['user'])) {
		header("Location: login.php");
	} else {
		$id = isset($_GET['id_barang']) ? $_GET['id_barang'] : "";

		$hapus = isset($_GET['hapus']) ? $_GET['hapus'] : "";
		if ($hapus != "") {
			$id = "";
			$data = select_data($hapus);
			if (sizeof($data) > 0) {
				if (delete_data($hapus)) echo '<div class="alert alert-success">Sukses hapus data barang dengan ID ('.$hapus.')!</div>';
				else echo '<div class="alert alert-danger">Gagal hapus data barang dengan ID ('.$hapus.')!</div>';
			} else {
				echo '<div class="alert alert-danger">ID ('.$hapus.') tidak ditemukan!</div>';
			}
		}


		if ($id != "") {
			if (isset($_POST['ganti'])) {
				$new_data['nama_barang'] = isset($_POST['nama_barang']) ? $_POST['nama_barang'] : "";
				$new_data['harga'] = isset($_POST['harga']) ? $_POST['harga'] : "";
				$new_data['stok'] = isset($_POST['stok']) ? $_POST['stok'] : "";
				$new_data['supp'] = isset($_POST['supp']) ? $_POST['supp'] : "";

				if ($new_data['nama_barang'] == "" || $new_data['harga'] == "" || $new_data['stok'] == "" || $new_data['supp'] == "") {
					echo '<div class="alert alert-danger">Pastikan semua kolom sudah diisi!</div>';
				} else {
					$data = select_data($id);
					if (sizeof($data) > 0) {
						if (update_data($id,$new_data)) echo '<div class="alert alert-success">Sukses ganti data barang dengan ID ('.$id.')!</div>';
						else echo '<div class="alert alert-danger">Gagal ganti data barang dengan ID ('.$hapus.')!</div>';
					}
				}
			}

			$data_table = '';
			$data = select_data($id);
			if (sizeof($data) > 0) {
				echo '
					<form method="post" action="cari_barang.php?id='.$id.'">
						<table class="table table-bordered table-hover">
							<tr>
								<th class="table-info" width="15%" nowrap>ID Barang</th>
								<td><input type="text" class="form-control" value="'.$id.'" disabled></td>
							</tr>
							<tr>
								<th class="table-info">Nama Barang</th>
								<td><input class="form-control" type="text" name="nama_barang" value="'.$data[0]['nama_barang'].'" required></td>
							</tr>
							<tr>
								<th class="table-info">Harga</th>
								<td><input class="form-control" type="text" name="harga" value="'.$data[0]['harga'].'" required></td>
							</tr>
							<tr>
								<th class="table-info">Stok</th>
								<td><input class="form-control" type="text" name="stok" value="'.$data[0]['stok'].'" required></td>
							</tr>
							<tr>
								<th class="table-info">Supplier ID</th>
								<td><input class="form-control" type="text" name="supp" value="'.$data[0]['supp'].'" required></td>
							</tr>
							<tr>
								<td colspan="2">
									<input class="btn btn-warning text-light" type="submit" name="ganti" value="GANTI">
									 &nbsp;&nbsp;&nbsp; 
									<a class="btn btn-danger text-light" href="data_barang.php?hapus='.$id.'">HAPUS</a>
								</td>
							</tr>
						</table>
					</form>
				';
			} else {
				echo '<div class="alert alert-danger">ID tidak ditemukan</div>';
			}
		}
	}
    ?>
    
    </div>
</body>