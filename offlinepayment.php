<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
 ?>
<?php 
	if(isset($_GET['orderId']) && $_GET['orderId']=='order'){
       $customerId = Session::get('customerId');
       $insertOrder = $ct->insertOrder($customerId);
       $delAllCart = $ct->delAllCart();
       header('Location:success.php');
    }
?>
 <style type="text/css">
	.box_left {
    width: 60%;
    border: 1px solid #666;
    float: left;
    padding: 4px;	

	}
 	.box_right {
    width: 37%;
    border: 1px solid #666;
    float: right;
    padding: 4px;
	}
	.a_order {
    background: red;
    color: aliceblue;
    padding: 10px;
    font-size: 25px;
    border-radius: none;
    cursor: pointer;
	}
}
</style>

<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="heading">
    		     <h3>Offline Payment</h3>
    		</div>
    		<div class="clear"></div>
    		<div class="box_left">
			<div class="cartpage">
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
								<th width="25%">Product Name</th>
								<th width="10%">Image</th>
								<th width="20%">Price</th>
								<th width="20%">Quantity</th>
								<th width="20%">Total Price</th>
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
								<td><?php echo $result['qty']; ?></td>
								<td>
									<?php 
										$totalPrice = $result['price'] * $result['qty'];
										echo '$'.number_format($totalPrice);
									?>
									
								</td>		

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
    		</div>
    		<div class="box_right">
		    	<table class="tblone">
		    		<tr>
		            <?php 
		                if (isset($updateProfile)) {
		                    echo '<td colspan="3">'.$updateProfile.'</td>';
		                }
		            ?>
		            </tr>
		    		<?php 
			    		$customerId = Session::get('customerId');
			    		$getCustomerById = $cur->getCustomerById($customerId);
			    		if ($getCustomerById) {
			    			while ($result = $getCustomerById->fetch_assoc()) {	
		    		?>
		    		<tr>
		    			<td>Name</td>
		    			<td>:</td>
		    			<td><?php echo $result['name']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Email</td>
		    			<td>:</td>
		    			<td><?php echo $result['email']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Address</td>
		    			<td>:</td>
		    			<td><?php echo $result['address']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Phone</td>
		    			<td>:</td>
		    			<td><?php echo $result['phone']; ?></td>
		    		</tr>
		    		
		    		<?php 
				    		}
			    		}
		    		 ?>
		    	</table>

    		</div>
 		</div>
 	</div>
 	<center style="padding-bottom: 20px;"><a href="?orderId=order" class="a_order">Oder Now</a></center>
 </div>
</form>
<?php 
	include 'inc/footer.php';
 ?>