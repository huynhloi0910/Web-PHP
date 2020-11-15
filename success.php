<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
 ?>

 <style type="text/css">
    h2.successOrder {
        text-align: center;
        color: red;
    }
    .successNote {
        text-align: center;
        padding: 8px;
        font-size: 17px;
    }

</style>

<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<h2 class="successOrder">Success Order</h2>
            <?php
                $customerId = Session::get('customerId'); 
                $getAmountPrice = $ct->getAmountPrice($customerId);
                if ($getAmountPrice) {
                    $subTotal = 0;
                    while ($result = $getAmountPrice->fetch_assoc()) {
                        $price = $result['price'];
                        $subTotal += $price;
                    }
                }
             ?>
            <p class="successNote">Total Price: <?php 
                echo '$'.number_format($subTotal);
             ?></p>
            <p class="successNote">We will contact you as soon as possible<a href="orderdetails.php"> Click here </a>to see your order details</p>
 		</div>
 	</div>
 	
 </div>
</form>
<?php 
	include 'inc/footer.php';
 ?>