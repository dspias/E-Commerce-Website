<?php include 'inc/header.php'; ?>
<?php
	if (isset($_GET['delPro'])) {
		$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delPro']);
		$delProduct = $ct->deleteCartProductById($id);
	}
	
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cartId 	= $_POST['cartId'];
        $quantity 	= $_POST['quantity'];
        $updCart 	= $ct->updateCartById($quantity, $cartId);
    }
?>

<?php
	if (!isset($_GET['id'])) {
		echo "<meta http-equiv='refresh' content='0;url=?id=live'/>";
	}
?>


 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>

			    <?php 
			    	if (isset($updCart)) {
			    		echo $updCart;
			    	}
			    	if(isset($delProduct)){
			    		echo $delProduct;
			    	}
			    ?>
						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
							</tr>

						<?php
							$getPro = $ct->getCartProduct();
							$i = 0;
							$sum = 0;
							if ($getPro) {
								while ($result = $getPro->fetch_assoc()) {
									$i++;

						?>
							
							<tr>
								<td> <?php echo $i; ?> </td>

								<td> <?php echo $result['productName']; ?> </td>

								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>

								<td> $ <?php echo $result['price']; ?> </td>

								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'];?>" min="1"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity'];?>" min="1"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>

								<td> $ 
									<?php
										$total = $result['price'] * $result['quantity'];
										$sum +=$total;
										echo $total;
								 	?>
								 </td>

								<td><a onclick="return confirm('Are you sure for delete this product')" href="?delPro=<?php echo $result['cartId'];?>">X</a></td>
							</tr>

						<?php } 
							} else{
								header("Location:index.php");
							}

						 ?>
							
						</table>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td> $ <?php 
								echo $sum;
								Session::set("sum",$sum);
								 ?> </td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>$ <?php $vat = $sum/10; echo $vat; ?></td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td> $ <?php echo ($vat+$sum); ?> </td>
							</tr>
					   </table>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 
<?php include 'inc/footer.php'; ?>
