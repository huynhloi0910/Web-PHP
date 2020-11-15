<?php 
	include 'inc/header.php';
 ?>	
 <?php 
	$loginCheck   = Session::get('customerLogin');
	$nameCustomer = Session::get('customerName');
	if ($loginCheck == false) {
		header('Location:login.php'); 
	}
 ?>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
				<div class="order_page">
					<a href="index.php"><h3>Hi ! <?php echo $nameCustomer ?> Shopping now</h3></a>
				</div>
					
			</div>
					
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php 
	include 'inc/footer.php';
 ?>