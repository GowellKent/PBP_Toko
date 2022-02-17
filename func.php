<?php
    require_once "Config.php";

    function check_login($user="", $pass=""){
        global $con;

        if ($user != "" && $pass !=""){
            try{
                $query = "SELECT * FROM tbl_admin WHERE user =:user and pass =:pass";
                $stmt = $con->prepare($query);
                $stmt->bindParam('user', $user, PDO::PARAM_STR);
                $stmt->bindParam('pass', $pass, PDO::PARAM_STR);
                $stmt->execute();
                $count = $stmt->rowCount();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($count == 1 && !empty($row)){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                echo "ERROR : ".$e->getMessage();
            }
        }else{
            return false;
        }
    }

    function check_login_kas($user="", $pass=""){
        global $con;

        if ($user != "" && $pass !=""){
            try{
                $query = "SELECT * FROM tbl_kasir WHERE user =:user and pass =:pass";
                $stmt = $con->prepare($query);
                $stmt->bindParam('user', $user, PDO::PARAM_STR);
                $stmt->bindParam('pass', $pass, PDO::PARAM_STR);
                $stmt->execute();
                $count = $stmt->rowCount();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($count == 1 && !empty($row)){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                echo "ERROR : ".$e->getMessage();
            }
        }else{
            return false;
        }
    }

    function select_data($item=""){
        global $con;

        $hasil = array();

        if($item != "") $sql = "SELECT * FROM tbl_barang_baru WHERE ID_Barang = :item";
        else $sql = "SELECT * from tbl_barang_baru";

        try{
            $stmt = $con->prepare($sql);
            if($item != "") $stmt->bindValue(':item', $item, PDO::PARAM_STR);

            if($stmt->execute()){
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $rs = $stmt->fetchAll();

                if($rs != null){
                    $i = 0;

                    foreach($rs as $val){
                        $hasil[$i]['id_barang'] = $val['ID_Barang'];
                        $hasil[$i]['nama_barang'] = $val['Nama_Barang'];
                        $hasil[$i]['harga'] = $val['Harga'];
                        $hasil[$i]['stok'] = $val['Stok'];
                        $hasil[$i]['supp'] = $val['ID_Supplier'];
                        $i++;
                    }
                }
            }
        }catch(Exception $e){
            echo 'Error select_data : '.$e->getMessage();
        }
        return $hasil;
    }

    function select_supp($supp=""){
        global $con;

        $hasil = array();

        if($supp != "") $sql = "SELECT * FROM tbl_supplier WHERE ID_Supplier = :supp";
        else $sql = "SELECT * from tbl_supplier";

        try{
            $stmt = $con->prepare($sql);
            if($supp != "") $stmt->bindValue(':supp', $supp, PDO::PARAM_STR);

            if($stmt->execute()){
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $rs = $stmt->fetchAll();

                if($rs != null){
                    $i = 0;

                    foreach($rs as $val){
                        $hasil[$i]['id_supplier'] = $val['ID_Supplier'];
                        $hasil[$i]['nama_supplier'] = $val['Nama_Supplier'];
                        $hasil[$i]['telp'] = $val['Telp'];
                        $hasil[$i]['alamat'] = $val['Alamat'];
                        $i++;
                    }
                }
            }
        }catch(Exception $e){
            echo 'Error select_data : '.$e->getMessage();
        }
        return $hasil;
    }

    function insert_data($data) {
		global $con;

		if ($data != null) {
			try {
				$sql = "INSERT INTO tbl_barang_baru VALUES (:id_barang, :nama_barang, :harga, :stok, :id_supplier)";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':id_barang', $data['id_barang'], PDO::PARAM_STR);
				$stmt->bindValue(':nama_barang', $data['nama_barang'], PDO::PARAM_STR);
				$stmt->bindValue(':harga', $data['harga'], PDO::PARAM_STR);
				$stmt->bindValue(':stok', $data['stok'], PDO::PARAM_STR);
                $stmt->bindValue(':id_supplier', $data['id_supplier'], PDO::PARAM_STR);


				if ($stmt->execute()) return true;
				else return false;

			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
		} else {
			return false;
		}
	}

    function delete_data($item="") {
		global $con;

		if ($item != "") {
			try {
				$sql = "DELETE FROM tbl_barang_baru WHERE ID_Barang = :item";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':item', $item, PDO::PARAM_STR);
				if ($stmt->execute()) return true;
				else return false;

			} catch(Exception $e) {
				echo 'Error delete_data : '.$e->getMessage();
				return false;
			}
		} else {
			return false;
		}
	}

    function update_data($id="",$data) {
		global $con;

		if ($data != null) {
			try {
				$sql = "UPDATE tbl_barang_baru SET Nama_Barang = :Nama_Barang, Harga = :Harga, Stok = :Stok, ID_Supplier = :ID_Supplier WHERE ID_Barang = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':id', $id, PDO::PARAM_STR);
				$stmt->bindValue(':Nama_Barang', $data['Nama_Barang'], PDO::PARAM_STR);
				$stmt->bindValue(':Harga', $data['Harga'], PDO::PARAM_STR);
				$stmt->bindValue(':Stok', $data['Stok'], PDO::PARAM_STR);
                $stmt->bindValue(':ID_Supplier', $data['ID_Supplier'], PDO::PARAM_STR);

				if ($stmt->execute()) return true;
				else return false;
			} catch(Exception $e) {
				echo 'Error update_data : '.$e->getMessage();
				return false;
			}
		} else {
			return false;
		}
	}

    function additem($data,$nama, $harga) {
		global $con;

		if ($data != null) {
			try {
				$sql = "INSERT INTO tbl_pesanan VALUES (:data, :nama_barang, :harga, :stok, :id_supplier)";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(':id_barang', $data['id_barang'], PDO::PARAM_STR);
				$stmt->bindValue(':nama_barang', $data['nama_barang'], PDO::PARAM_STR);
				$stmt->bindValue(':harga', $data['harga'], PDO::PARAM_STR);
				$stmt->bindValue(':stok', $data['stok'], PDO::PARAM_STR);
                $stmt->bindValue(':id_supplier', $data['id_supplier'], PDO::PARAM_STR);


				if ($stmt->execute()) return true;
				else return false;

			} catch(Exception $e) {
				echo 'Error insert_data : '.$e->getMessage();
				return false;
			}
		} else {
			return false;
		}
	}

    function select_data_orders($item=""){
        global $con;

        $hasil = array();

        if($item != "") $sql = "SELECT * FROM orders WHERE id = :item";
        else $sql = "SELECT * from orders";

        try{
            $stmt = $con->prepare($sql);
            if($item != "") $stmt->bindValue(':item', $item, PDO::PARAM_STR);

            if($stmt->execute()){
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $rs = $stmt->fetchAll();

                if($rs != null){
                    $i = 0;

                    foreach($rs as $val){
                        $hasil[$i]['id'] = $val['id'];
                        $hasil[$i]['name'] = $val['name'];
                        $hasil[$i]['datecreation'] = $val['datecreation'];
                        $hasil[$i]['status'] = $val['status'];
                        $hasil[$i]['user'] = $val['user'];
                        $i++;
                    }
                }
            }
        }catch(Exception $e){
            echo 'Error select_data : '.$e->getMessage();
        }
        return $hasil;
    }

    function order_detail($item=""){
        global $con;

        $hasil = array();

        if($item != "") $sql = "SELECT * FROM orderdetail WHERE orderid = :item";
        else $sql = "SELECT * from orderdetail";

        try{
            $stmt = $con->prepare($sql);
            if($item != "") $stmt->bindValue(':item', $item, PDO::PARAM_STR);

            if($stmt->execute()){
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $rs = $stmt->fetchAll();

                if($rs != null){
                    $i = 0;

                    foreach($rs as $val){
                        $hasil[$i]['productid'] = $val['productid'];
                        $hasil[$i]['orderid'] = $val['orderid'];
                        $hasil[$i]['price'] = $val['price'];
                        $hasil[$i]['quantity'] = $val['quantity'];
                        $i++;
                    }
                }
            }
        }catch(Exception $e){
            echo 'Error select_data : '.$e->getMessage();
        }
        return $hasil;
    }

?>