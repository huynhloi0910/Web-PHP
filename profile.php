<?php
	include 'inc/header.php';
?>
<?php 
	$checkLogin = Session::get('customerLogin');
	if ($checkLogin == false) {
		header('Location:login.php');
	} 
?>
<?php
	//Update Profile
	$customerId = Session::get('customerId');
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateProfile'])) {
		$updateProfile = $cur->updateProfile($_POST, $customerId);
	}
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
				<div class="heading">
					<h3>Profile Customer</h3>
				</div>
				<div class="clear"></div>
    		</div>
    		<form action="" method="post">
		    	<table class="tblone">
		    		<tr>
		            <?php 
		                if (isset($updateProfile)) {
		                    echo '<td colspan="3">'.$updateProfile.'</td>';
		                }
		            ?>
		            </tr>
		    		<?php 
			    		$customerId = Session::get('customerId');
			    		$getCustomerById = $cur->getCustomerById($customerId);
			    		if ($getCustomerById) {
			    			while ($result = $getCustomerById->fetch_assoc()) {	
		    		?>
		    		<tr>
		    			<td>Name</td>
		    			<td>:</td>
		    			<td><input type="text" name="name" value="<?php echo $result['name']; ?>"></td>
		    		</tr>
		    		<tr>
		    			<td>Email</td>
		    			<td>:</td>
		    			<td><input type="email" name="email" value="<?php echo $result['email']; ?>"></td>
		    		</tr>
		    		<tr>
		    			<td>Address</td>
		    			<td>:</td>
		    			<td><input type="text" name="address" value="<?php echo $result['address']; ?>"></td>
		    		</tr>
		    		<tr>
		    			<td>Phone</td>
		    			<td>:</td>
		    			<td><input type="text" name="phone" value="<?php echo $result['phone']; ?>"></td>
		    		</tr>
		            <tr>
		                <td colspan="3"><input type="submit" name="updateProfile" value="Update Profile"></td>      
		            </tr>
		    		
		    		<?php 
				    		}
			    		}
		    		 ?>
		    	</table>
		    </form>
 		</div>
 	</div>

<?php
	include 'inc/footer.php';
?>

