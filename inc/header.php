<?php
    include 'lib/session.php';
    //Khởi tạo session
    Session::init();
?>
<?php
	include_once 'lib/db.php';
	include_once 'helpers/format.php';

	//Hàm tự động lấy classes mà không cần phải include 
	//Từ classes nó sẽ auto lấy những file bên trong nó
	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});

	$db  = new Database();
	$fm  = new Format();
	$ct  = new Cart();
	$ur  = new User();
	$cat = new Category();
	$prd = new Product();
	$cur = new Customer();
	$cpr = new Compare();
	$slr  = new Slider();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="post">
				    	<input type="text" name="searchProduct" placeholder="Search for Products" >
				    	<input type="submit" name="search" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php">
							<span class="cart_title">Cart</span>
							<span class="no_product">
								
							<?php
								$getProductCart = $ct->getProductCart();//addToCart/Cart
								if ($getProductCart) {
								 	$sum = Session::get("sum");
								 	$qty = Session::get("qty");
									echo '($'.number_format($sum).' '.' SL: '.$qty.')';
								}else {
								 	echo '(Empty)';
								} 
							 ?>
							</span>
						</a>
					</div>
			    </div>
				<?php 
					//Khi người dùng nhấn logout thì 
					if (isset($_GET['customerId'])) {
						$customerId 	= $_GET['customerId'];
						$delAllCart     = $ct->delAllCart();
						$delCompare 	= $cpr->delCompare($customerId);
						$delAllWishlist = $cpr->delAllWishlist($customerId);
						Session::destroy();
					}
				?>
		   <div class="login">
		   	<?php 
		   		//Khi người dùng đã đăng nhập thì xuất hiện chữ login
		   		$checkLogin = Session::get('customerLogin');
		   		if ($checkLogin == false) {
		   			echo "<a href='login.php'>Login</a></div>";
		   		} else {
		   			echo '<a href=?customerId='.Session::get('customerId').'">Logout</a></div>';//loginCustomer/Customer
		   		}
		   	?>
		   	
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	<?php
		//Nếu có sp thì hiện cart
		$getProductCart = $ct->getProductCart();//addToCart/Cart
		if ($getProductCart) {
			echo "<li><a href='cart.php'>Cart</a></li>";
		} else {
			echo "";
		}					
	?>

	<?php
	//Nếu ng dùng có đặt hàng thì hiện order
		$customerId = Session::get('customerId'); 
		$getOder = $ct->getOder($customerId);
		if ($getOder) {
			echo "<li><a href='orderdetails.php'>Oder</a></li>";
		} else {
			echo "";
		}					
	?>

	<?php
	  //Nếu mà người dùng có đăng nhập thì mới hiển thị Profile, Compare, Wishlist
 		$loginCheck = Session::get('customerLogin');
		if ($loginCheck == false) {
			echo ""; 
		} else {
			echo "<li><a href='profile.php'>Profile</a></li>";
		}
	?>

	<?php
 		$loginCheck = Session::get('customerLogin');
		if ($loginCheck) {
			echo '<li><a href="compare.php">Compare</a></li>';
		}
	?>

	<?php
 		$loginCheck = Session::get('customerLogin');
		if ($loginCheck) {
			echo '<li><a href="wishlist.php">Wishlist</a></li>';
		}
	?>	
	<li><a href="contact.php">Contact</a></li>  
	<div class="clear"></div>
	</ul>
</div>