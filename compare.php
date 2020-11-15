<?php
	include 'inc/header.php';
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare</h2>
						<table class="tblone">
							<tr>
								<th width="10%">ID Compare</th>
								<th width="20%">Product Name</th>
								<th width="20%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Action</th>
							</tr>
							<?php 
								$customerId = Session::get('customerId');
								$getCompare = $cpr->getCompare($customerId);
								if($getCompare){
									$i = 0;
									while ($result = $getCompare->fetch_assoc()) {
									$i++;	
							?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" style="width:55px;image-rendering: pixelated" alt=""/></td>
								<td><?php echo '$'.number_format($result['price']) ?></td>			
								<td><a href="details.php?productId=<?php echo $result['productId'] ?>">View</a></td>
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


