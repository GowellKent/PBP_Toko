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
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark"> 
		<a class="navbar-brand" href="index.php">ADMIN PANEL</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav">
				<li class="nav-item"> 
					<a class="nav-link" href="data_barang.php">Data Barang</a>
				</li>
				<li class="nav-item"> 
					<a class="nav-link" href="data_supp.php">Data Supplier</a>
				</li>
				<li class="nav-item"> 
					<a class="nav-link" href="input_barang.php">Input Barang</a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"> 
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container" style="margin-top:50px">
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
				$new_data['Nama_Barang'] = isset($_POST['Nama_Barang']) ? $_POST['Nama_Barang'] : "";
				$new_data['Harga'] = isset($_POST['Harga']) ? $_POST['Harga'] : "";
				$new_data['Stok'] = isset($_POST['Stok']) ? $_POST['Stok'] : "";
				$new_data['ID_Supplier'] = isset($_POST['ID_Supplier']) ? $_POST['ID_Supplier'] : "";

				if ($new_data['Nama_Barang'] == "" || $new_data['Harga'] == "" || $new_data['Stok'] == "" || $new_data['ID_Supplier'] == "") {
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