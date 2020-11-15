<?php
	include 'inc/header.php';
?>
<?php
	if (!isset($_GET['catId']) && $_GET['catId'] == NULL) {
        echo "<script> window.location = '404.php' </script>";
    } else {
        $catId = $_GET['catId'];// Lấy catid trên host
    }
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<?php
		    	$getCatName = $cat->getCateById($catId);
		    	if ($getCatName) {
		    		while ($resultCatName = $getCatName->fetch_assoc()) {
	    	?>
    		<h3>Category : <?php echo $resultCatName['catName']; ?></h3>
    		<?php
		    		}
		    	}
			?>
    		</div>
    		<div class="clear"></div>
    	</div>
	    <div class="section group">
	    <?php
	    	$getProductByCat = $cat->getProductByCat($catId);
	    	if ($getProductByCat) {
	    		while ($result = $getProductByCat->fetch_assoc()) {
	    ?>
			<div class="grid_1_of_4 images_1_of_4">
				 <a href="preview-3.php"><img src="admin/uploads/<?php echo $result['image'] ?>" style="height: 150px; image-rendering: pixelated" alt="" /></a>
				 <h2><?php echo $result['productName']; ?></h2>
				 <p><?php echo $result['productDesc']; ?></p>
				 <p><span class="price"><?php echo '$'.number_format($result['price'])?></span></p>
			     <div class="button"><span><a href="details.php?productId=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
			</div>
		<?php
	    		}
	    	} else {
	    			echo "Category is not available";
	    		}
		?>
		</div>
    </div>
 </div>
<?php
	include 'inc/footer.php';
?>

