<?php
	include 'inc/header.php';
?>
<?php
	if (isset($_GET['cartId'])) {
		$cartId = $_GET['cartId'];
		$delProductCart = $ct->delProductCart($cartId);
	}
	//Update quantity cart
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateQty'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $cartId = $_POST['cartId'];
       	$qty = $_POST['qty'];
       	$updateQty = $ct -> updateQty($cartId, $qty); 
       	if ($qty <= 0) {
       		$delProductCart = $ct->delProductCart($cartId);
       	}
    }

?>
 <?php
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php
			    		if (isset($updateQty)) {
			    			echo $updateQty;
			    		}
			    	?>
			    	<?php
			    		if (isset($delProductCart)) {
			    			echo $delProductCart;
			    		}
			    	?>
						<table class="tblone">
							<tr>
								<th width="5%">No.</th>
								<th width="15%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
								$getProductCart = $ct->getProductCart();
								if ($getProductCart) {
									$subTotal = 0;
									$qty = 0;
									$i   = 0;
									while ($result = $getProductCart->fetch_assoc()) {
										$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" style="height: 40px ; width: 50px ; image-rendering: pixelated" alt=""/></td>
								<td><?php echo '$'.number_format($result['price']) ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>"/>
										<input type="number" name="qty"  max="100"  value="<?php echo $result['qty'] ?>"/>
										<input type="submit" name="updateQty" value="Update"/>
									</form>
								</td>
								<td>
									<?php 
										$totalPrice = $result['price'] * $result['qty'];
										echo '$'.number_format($totalPrice);
									?>
									
								</td>
								<td><a onclick = "return confirm('Are you want to delete???')" href="?cartId=<?php echo $result['cartId'] ?>">Xóa</a></td>			

							</tr>	
							<?php	
										$subTotal += $totalPrice;
										$qty += $result['qty'];										
									}
								}

					   		?>	
						</table>
						<br>
						<br>
						<?php
							//Neu sp co ton tai
							$getProductCart = $ct->getProductCart();
							if ($getProductCart) {

						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>
									<?php 
										echo '$'.number_format($subTotal); 
										Session::set('sum',$subTotal);
									 	Session::set('qty',$qty);
									?>	
								</td>
							</tr>
					   </table>
					   	<?php 
							}else {
								echo '<span class="error">Your Cart is Empty ! Please Shopping Now</span>';
							}
					    ?>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php
	include 'inc/footer.php';
?>


