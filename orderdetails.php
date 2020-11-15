<?php
	include 'inc/header.php';
?>
<?php 
	$checkLogin = Session::get('customerLogin');
	if ($checkLogin == false) {
		header('Location:login.php');
	} 
?>

 <?php
	if(isset($_GET['confirmid'])){
     	$id = $_GET['confirmid'];
     	$time = $_GET['time'];
     	$price = $_GET['price'];
     	$shifted_confirm = $ct->shifted_confirm($id,$time,$price);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2 style="width: 500px;">Your Ordered Details</h2>
						<table class="tblone">
							<tr>
								<th width="5%">No.</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="10%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="20%">Date</th>
								<th width="10%">Status</th>
								<th width="10%">Action</th>
							</tr>
							<?php
								$customerId = Session::get('customerId'); 
								$getOder = $ct->getOder($customerId);
								if ($getOder) {
									$i   = 0;
									while ($result = $getOder->fetch_assoc()) {
										$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" style="height: 40px ; width: 50px ; image-rendering: pixelated" alt=""/></td>
								<td><?php echo $result['qty']; ?></td>
								<td><?php echo '$'.number_format($result['price']) ?></td>
								<td><?php echo $fm->formatDate($result['dateOrder']) ?></td>
								<td>
								<?php  //Status
									if ($result['status'] == '0') {
										echo "Pending";

									} elseif($result['status'] == 1) {
								?>
									<span>Shifted</span>
								<?php
									} else {
										echo 'Received';
									}	
								 ?>
								</td>



								<?php //Action
									if ($result['status'] == '0') {
								?>
										<td><?php echo 'Please Wait'; ?></td>
								<?php 
									}elseif ($result['status'] == 1){
								?>
										<td><a href="?confirmid=<?php echo $customerId ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['dateOrder'] ?>">Confirm</a></td>
								<?php
									}elseif ($result['status'] == 2) {
								?>
								  		<td><?php echo 'Received'; ?></a>
								 </td>
								<?php
									}
								?>

							</tr>	
							<?php									
									}
								}

					   		?>	
						</table>

			</div>
			<div class="shopping">
				<div class="shopleft" style="margin-left: 250px;">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php
	include 'inc/footer.php';
?>


