<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
 ?>
 <?php 
    //Khi checkout mà chưa đăng nhập thì quay về lại login
	  $login_check = Session::get('customerLogin');
	  if ($login_check==false) {
	  	header('Location:login.php');
	  } 
?>
<!-- <?php 
	// if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
 //        echo "<script> window.location = '404.php' </script>";
        
 //    }else {
 //        $id = $_GET['proid']; // Lấy productid trên host
 //    }

 //    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
 //        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
 //        $quantity = $_POST['quantity'];
 //        $AddtoCart = $ct -> add_to_cart($id, $quantity); // hàm check catName khi submit lên
 //    } 
 ?> -->
 <style>
    h3.payment {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    text-decoration: underline;
    }
    .wrapper_method {
    text-align: center;
    width: 550px;
    margin: 0 auto;
    border: 1px solid #666;
    padding: 20px;
    /* margin: 20px; */
    background: cornsilk;
    }
    .wrapper_method a {
    padding: 10px;
  
    background: red;
    color: #fff;
    
    }
    .wrapper_method h3 {
     margin-bottom: 20px;
    }
</style>
 <div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
            <div class="heading">
                 <h3>Payment Method</h3>
            </div>
            <div class="clear"></div>
            <div class="wrapper_method">
                <h3 class="payment">Choose your method payment</h3>
                <a href="offlinepayment.php">Offline payment</a>
                <a href="onlinepayment.php">Online payment</a>
                <br><br><br>
                <a style="background:grey" href="cart.php"> << Back to your cart</a>
            </div>

        </div>
        
        </div>  
    </div>

<?php 
	include 'inc/footer.php';
 ?>