<?php
	include 'inc/header.php';
?>
<?php
	if (!isset($_GET['productId']) && $_GET['productId'] == NULL) {
        echo "<script> window.location = '404.php' </script>";
    } else {
        $productId = $_GET['productId'];
    }

    //Compare Product
    $customerId = Session::get('customerId');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compareProduct'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $productId = $_POST['productId'];
        $insertCompare = $cpr -> insertCompare($productId, $customerId); 
    }

    //Save to Wishlist
    $customerId = Session::get('customerId');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlistProduct'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $productId = $_POST['productId'];
        $insertWhislist = $cpr -> insertWhislist($productId, $customerId); 
    }

    //Add to cart
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addToCart'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        // $productId = $_POST['productId'];
       	$qty = $_POST['qty'];
       	$addToCart = $ct -> addToCart($productId, $qty); 
    }

?>
<style type="text/css">
	.note {
		color: red;
	}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php
    			$getProductDetails = $prd->getProductDetails($productId);
    			if ($getProductDetails) {
    				while ($resultDetails = $getProductDetails->fetch_assoc()) {
    		?>
			<div class="cont-desc span_1_of_2">				
				<div class="grid images_3_of_2">
					<img src="admin/uploads/<?php echo $resultDetails['image'] ?>" style="height: 200px; image-rendering: pixelated" alt="" />
				</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $resultDetails['productName'] ?></h2>
					<p><?php echo $resultDetails['productDesc'] ?></p>					
					<div class="price">
						<p>Price: <span><?php echo '$'.number_format($resultDetails['price'])?></span></p>
						<p>Category: <span><?php echo $resultDetails['catName'] ?></span></p>
						<p>Brand:<span><?php echo $resultDetails['brandName'] ?></span></p>
					</div>
					<!-- add to cart -->
					<div class="add-cart">
						<form action="" method="POST">
							<input type="number" name="qty" min="1" max="100" class="buyfield" value="1"/>
							<input type="submit" name="addToCart" class="buysubmit" value="Buy Now"/>
						</form>
						<?php
							if (isset($addToCart)) {
								echo '<span style="color:red; font-size:18px;">Product Already Added</span>';
							}
						?>				
					</div>
					<!-- so sánh sản phẩm -->
					<div class="add-cart">
						<div class="button_details">
							<form action="" method="post">
								<input type="hidden" name="productId" value="<?php echo $resultDetails['productId'] ?>"/>		
							<?php
							//Khi người dùng đã đăng nhập thì mới hiện nút compareProduct và Save to Whilist
						 		$loginCheck = Session::get('customerLogin');
								if ($loginCheck) {
									echo '<input type="submit" class="buysubmit" name="compareProduct" value="Compare Product"/>'.' ';
								} else {
									echo '';
								}
							?>	

							</form>	

							<form action="" method="post">
								<input type="hidden" name="productId" value="<?php echo $resultDetails['productId'] ?>"/>		
							<?php
							//Khi người dùng đã đăng nhập thì mới hiện nút compareProduct và Save to Whilist
						 		$loginCheck = Session::get('customerLogin');
								if ($loginCheck) {
									echo '<input type="submit" class="buysubmit" name="wishlistProduct" value="Save to Wishlist"/>';
								} else {
									echo '';
								}
							?>	

							</form>				
						</div>
						<div class="clear"></div>
						<?php
							if (isset($insertCompare)) {
								echo $insertCompare;
							}
						?>
						
						<?php
							if (isset($insertWhislist)) {
								echo $insertWhislist;
							}
						?>
					</div>
				</div>
					<div class="product-desc">
					<h2>Product Details</h2>
					<p><?php echo $resultDetails['productDesc'] ?></p>
			    	</div>
					
			</div>
			<?php
    				}
    			}
			?>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
				<?php
					$cat = $cat->showCategory();
					if ($cat) {
						while ($resultCat = $cat->fetch_assoc()) {
				?>
			      <li><a href="productbycat.php?catId=<?php echo $resultCat['catId'] ?>"><?php echo $resultCat['catName']; ?></a></li>
			    <?php
						}
					}
			    ?>
				</ul>

			</div>
 		</div>
 	</div>


<?php
	include 'inc/footer.php';
?>

