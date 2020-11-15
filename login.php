<?php
	include 'inc/header.php';
?>
<?php
    //Lấy dl ở form bằng phương thức post
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
        //Lấy tất cả dl khi nhấn submit form và dùng phương thức post để gửi vào $_POST rồi qua hàm insertCustomer
        //Gọi hàm insertProduct trong class Product và truyền vào 2 tham số 
        $insertCustomer = $cur->insertCustomer($_POST);

    }
?>
<?php
    //Lấy dl ở form bằng phương thức post
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        //Lấy tất cả dl khi nhấn submit form và dùng phương thức post để gửi vào $_POST rồi qua hàm insertCustomer
        //Gọi hàm insertProduct trong class Product và truyền vào 2 tham số 
        $loginCustomer = $cur->loginCustomer($_POST);
    }
?>
 <?php 
	$loginCheck = Session::get('customerLogin');
	if ($loginCheck) {
		header('Location:order.php'); 
	}
?>
 <div class="main">
    <div class="content">

    	<div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<?php 
    			if (isset($loginCustomer)) {
    				echo $loginCustomer;
    			}
    		?>
        	<form action="" method="post">
        		<input type="text" name="emailLogin" placeholder="Enter Your E-Mail">
        		<input type="password" name="passwordLogin" placeholder="Password">
                <input type="submit" name="login" class="grey" value="Login" 
		   			style="margin-top: 5px;padding: 10px;color: green;cursor :pointer;">
            </form>
        </div>


    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<?php 
    			if (isset($insertCustomer)) {
    				echo $insertCustomer;
    			}
    		?>
    		<form action="" method="post">
		   		<table>
		   			<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Name">					
								</div>
								
								<div>
									<input type="text" name="email" placeholder="E-Mail">		   
								</div>
								

								<div>
									<input type="password" name="password" placeholder="Password" style="width: 91%;height: 33px;margin-top: 7px;">
								</div>
			    			</td>

			    			<td>
								<div>
									<input type="text" name="address" placeholder="Address">
								</div>
			        
			
					           	<div>
					          		<input type="text" name="phone" placeholder="Phone">
					          	</div>
			    			</td>
		    			</tr> 
		   		 	</tbody>
				</table> 
		   		<div class="search"><div><input type="submit" name="register" class="grey" value="Create Account" 
		   			style="margin-top: 5px;padding: 10px;color: red;cursor :pointer;"></div></div>
		    	<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    	<div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
	include 'inc/footer.php';
?>