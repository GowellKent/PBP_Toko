<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="templates/bootstrap.min.css">
	<script src="templates/jquery.min.js"></script>
	<script src="templates/popper.min.js"></script>
	<script src="templates/bootstrap.min.js"></script>
</head>
<body style="background-color: #f0f0f0;">
	<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #007291;"> 
		<a class="navbar-brand" href="login.php">LOGIN PAGE</a>
	</nav>
	<div class="container" style="margin-top:50px">
<?php
require_once "func.php";

if (isset($_SESSION['user'])) {
	header("Location: index.php");
} else {
	if (isset($_POST['login'])) {
		$user = $_POST['user'];
		$pass = $_POST['pass'];

		if (check_login($user, $pass)) {
			$_SESSION['user'] = $user;
			header("Location: index.php");
		}elseif(check_login_kas($user, $pass)){
			$_SESSION['user'] = $user;
			header("Location: index_kasir.php");
		}else {
			echo '<div class="alert alert-danger">Username/Password salah!</div>';
		}
	}

	echo '
	<form method="post">
		<table style="margin-left : 30%; margin-top : 25%;width: 40%; background-color: #007291;" class="table table-dark table-borderless">
			<tr>
				<td colspan=2><center><img src="gambar/person.svg" class="img-thumbnail rounded" width="30%" alt="person.svg"></center></td>
			</tr>
			<tr>
				<th width="5%" nowrap style="text-align: center">Username</th>
				<td><input class="form-control" type="text" name="user" required></td>
			</tr>
			<tr>
				<th width="5%" nowrap style="text-align: center">Password</th>
				<td><input class="form-control" type="password" name="pass" required></td>
			</tr>
			<tr>
				<td style="text-align: right;" colspan="2" width="30%"><input  class="btn btn-success" type="submit" name="login" value="LOGIN"></td>
			</tr>
		</table>
		
	</form>
';
}
?>
	</div>
</body>

</html>