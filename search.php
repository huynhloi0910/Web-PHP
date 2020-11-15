<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<style type="text/css">
	.phantrang {
	width: 100%;
    display: inline-block;
    margin-top: 10px;
    text-align: center;
	}

	.phantrang a {
		display: inline-block;
	    margin: 0px 2px;
	    background: #d2577e;
	    padding: 5px 10px;
	    color: #fff;
	}

</style>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
		$key = $_POST['searchProduct'];
		//echo $productName;
		$findProduct = $prd->findProduct($key);
       	
    }
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Keyword Search : <?php echo $key; ?> 
    		</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	    <div class="section group">
    	<?php
      		if ($findProduct) {
      			while ($result = $findProduct->fetch_assoc()) {
      	?>
			<div class="grid_1_of_4 images_1_of_4">
				 <a href="details.php?productId=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" style="height: 150px; image-rendering: pixelated" alt="" /></a>
				 <h2><?php echo $result['productName']; ?></h2>
				 <p><?php echo $result['productDesc']; ?></p>
				 <p><span class="price"><?php echo '$'.number_format($result['price']) ?></span></p>
			     <div class="button"><span><a href="details.php?productId=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
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

