<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/cart.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	$ct = new Cart();
    if(isset($_GET['shiftid'])){
    	$id = $_GET['shiftid'];
    	$time = $_GET['time'];
    	$price = $_GET['price'];
    	$shifted = $ct->shifted($id,$time,$price);
    }

    if(isset($_GET['delid'])){
    	$id = $_GET['delid'];
    	$time = $_GET['time'];
    	$price = $_GET['price'];
    	$del_shifted = $ct->del_shifted($id,$time,$price);
    }
?>



        <div class="grid_10">
            <div class="box round first grid">
                <h2>Order</h2>
                <div class="block">  
                <?php 
	                if (isset($shifted)) {
	                	echo $shifted;
	                }
                ?> 
                
                <?php 
	                if (isset($del_shifted)) {
	                	echo $del_shifted;
	                }
                 ?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Date Oder</th>
							<th>Product Name</th>
							<th>Image</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Customer</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$ct = new Cart();
							$fm = new Format();
							$getAllOrder = $ct->getAllOrder();
							if ($getAllOrder) {
								$i = 0;
								while ($result = $getAllOrder->fetch_assoc()) {
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $fm->formatDate($result['dateOrder']) ?></td>
							<td><?php echo $result['productName']?></td>
							<td><img src="uploads/<?php echo $result['image'] ?>" style="height: 40px ; width: 50px ; image-rendering: pixelated" alt=""/></td>
							<td><?php echo $result['qty']?></td>
							<td><?php echo $result['price']?></td>
							<td><a href="customer.php?customerId=<?php echo $result['customerId']?>">View Customer</a></td>
							<td>
								<?php 
								if ($result['status']==0){
								 ?>

									<a href="?shiftid=<?php echo $result['id'] ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['dateOrder'] ?>">Pending...</a>
								 
								<?php 
								}elseif ($result['status']==1) {
								 ?>
								 	<?php
								 		echo "Shifting...";
								 	?>
								<?php 
								}elseif ($result['status'] == 2) {
								?>
									<a onclick = "return confirm('Are you want to remove???')" href="?delid=<?php echo $result['id'] ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['dateOrder'] ?>">Remove</a>
								 <?php 
								}
								 ?>
							</td>
						</tr>
						<?php
								}
							}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
