<?php
	include 'inc/header.php';
	include 'inc/slider.php';
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	        <div class="section group">
	      	<?php
	      		$getFeatureProduct = $prd->getFeatureProduct();
	      		if ($getFeatureProduct) {
	      			while ($resultFeature = $getFeatureProduct->fetch_assoc()) {
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productId=<?php echo $resultFeature['productId'] ?>"><img src="admin/uploads/<?php echo $resultFeature['image'] ?>" style="height: 150px; image-rendering: pixelated" alt="" /></a>
					 <h2><?php echo $resultFeature['productName']; ?></h2>
					 <p><?php echo $resultFeature['productDesc']; ?></p>
					 <p><span class="price"><?php echo '$'.number_format($resultFeature['price']) ?></span></p>
				     <div class="button"><span><a href="details.php?productId=<?php echo $resultFeature['productId'] ?>" class="details">Details</a></span></div>
				</div>
			<?php
	      			}
	      		}
			?>
			</div>
		<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
	      		$getNewProduct = $prd->getNewProduct();
	      		if ($getNewProduct) {
	      			while ($resultNew = $getNewProduct->fetch_assoc()) {
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productId=<?php echo $resultNew['productId'] ?>"><img src="admin/uploads/<?php echo $resultNew['image'] ?>" style="height: 150px; image-rendering: pixelated" alt="" /></a>
					 <h2><?php echo $resultNew['productName']; ?></h2>
					 <p><?php echo $resultNew['productDesc']; ?></p>
					 <p><span class="price"><?php echo '$'.number_format($resultNew['price']) ?></span></p>
				     <div class="button"><span><a href="details.php?productId=<?php echo $resultNew['productId'] ?>" class="details">Details</a></span></div>
				</div>
			<?php
	      			}
	      		}
			?>
			</div>
    </div>
 </div>

<?php
	include 'inc/footer.php';
?>

