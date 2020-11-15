<?php
	include 'inc/header.php';
	include 'inc/slider.php';
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

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>All Products : 
    			<?php
					if (isset($_GET['page'])) {
						echo 'Page '.$page = $_GET['page'];
					} else {
						$page = '';
					}
				?>
    		</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	    <div class="section group">
    	<?php
      		$getPageProduct = $prd->getPageProduct();
      		if ($getPageProduct) {
      			while ($result = $getPageProduct->fetch_assoc()) {
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
		<div class="phantrang">
			<?php
				$allProduct = $prd->getAllProduct();
				$count = mysqli_num_rows($allProduct);
				//Mỗi trang tối đa 4 sản phẩm va hàm ceil làm tròn page
				$page = ceil($count/4);
				for ($i = 1; $i <= $page ; $i++) { 
					echo '<a href="?page='.$i.'">'.$i.'</a>';
				}
			?>
		</div>
    </div>
 </div>

<?php
	include 'inc/footer.php';
?>

