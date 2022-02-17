<?php
echo '
<!DOCTYPE html>
<head>
<title>Keranjang Belanja</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="templates/bootstrap.min.css">
	<script src="templates/jquery.min.js"></script>
	<script src="templates/popper.min.js"></script>
	<script src="templates/bootstrap.min.js"></script>
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
        </nav>';
        
            require 'config.php';
            require 'item.php';

            if(isset($_GET['idb']) && !isset($_POST['update']))  { 

                $sql = "SELECT * FROM tbl_barang_baru WHERE ID_Barang=".$_GET['idb'];
                $result = mysqli_query($conn, $sql);
                $product = mysqli_fetch_object($result); 
                $item = new Item();
                $item->id = $product->ID_Barang;
                $item->name = $product->Nama_Barang;
                $item->price = $product->Harga;
                $iteminstock = $product->Stok;
                $item->quantity = 1;
                //Periksa produk dalam keranjang
                $index = -1;
                $cart = unserialize(serialize($_SESSION['cart']));
                for($i=0; $i<count($cart);$i++)
                    if ($cart[$i]->id == $_GET['idb']){
                        $index = $i;
                        break;
                    }
                    if($index == -1) 
                        $_SESSION['cart'][] = $item; //$ _SESSION ['cart']: set $ cart sebagai variabel _session
                    else {
                        
                        if (($cart[$index]->quantity) < $iteminstock)
                            $cart[$index]->quantity ++;
                            $_SESSION['cart'] = $cart;
                    }
            }
            //Menghapus produk dalam keranjang
            if(isset($_GET['index']) && !isset($_POST['update'])) {
                $cart = unserialize(serialize($_SESSION['cart']));
                unset($cart[$_GET['index']]);
                $cart = array_values($cart);
                $_SESSION['cart'] = $cart;
            }
            // Perbarui jumlah dalam keranjang
            if(isset($_POST['update'])) {
            $arrQuantity = $_POST['quantity'];
            $cart = unserialize(serialize($_SESSION['cart']));
            for($i=0; $i<count($cart);$i++) {
                $cart[$i]->quantity = $arrQuantity[$i];
            }
            $_SESSION['cart'] = $cart;
            }
        
            echo '
        <div class="container rounded" style="margin-top:50px; background-color: #ffffff; padding-top:20px; padding-bottom:10px;">
            <h2> Keranjang Belanja </h2> 
            <br />
            <form method="POST">
            <table class="table table-bordered" id="t01">
                <tr class="header text-light" scope="col" align="center" style="background-color: #007291;">
                    <th>Option</th>
                    <th>ID_Barang</th>
                    <th>Nama_Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>    
                    <th>Subtotal</th>
                </tr>';
            
                $cart = unserialize(serialize($_SESSION['cart']));
                $s = 0;
                $index = 0;
                for($i=0; $i<count($cart); $i++){
                        $s += $cart[$i]->price * $cart[$i]->quantity;
                
                        echo '
                    <tr>
                        <td><center><a class="btn btn-outline-danger" href="cart.php?index='.$index.'" onclick="return confirm("Are you sure?")" >Delete</a></center></td>
                        <td> '.$cart[$i]->id.'</td>
                        <td> '.$cart[$i]->name.'</td>
                        <td>Rp '.$cart[$i]->price.'</td>
                        <td> '.$cart[$i]->quantity.' pcs </td>  
                        <td> Rp '.$cart[$i]->price * $cart[$i]->quantity.' </td> 
                    </tr>';
                    
                        $index++;
                }
                echo '
                <tr>
                    <td colspan="5" style="text-align:right; font-weight:bold">Total 
                    <input type="hidden" name="update">
                    </td>
                    <td> Rp '.$s.' </td>
                </tr>
            </table>
            </form>
            <br>
            <a class="btn btn-info" href="index_kasir.php">Continue Shopping</a> | <a class="btn btn-success" href="detail_trans_kas.php">Checkout</a>';
            
                if(isset($_GET["idb"]) || isset($_GET["index"])){
                header('Location: cart.php');
                } 
            echo'
        </div>
    </body>';
?>