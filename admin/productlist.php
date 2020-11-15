<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/brand.php';  ?> 
<?php include '../classes/product.php';  ?>
<?php require_once '../helpers/format.php'; ?>
<?php
	$fm  = new Format();
	$prd = new Product();
    if(isset($_GET['productId'])){  
        $delId = $_GET['productId']; // Lấy delId trên host
        $delProduct = $prd -> delProduct($delId); // hàm check delete Name khi submit lên
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">  
       	<?php 
            if(isset($delProduct)){
                echo $delProduct;
            }
         ?>    
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Image</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Short Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$prdList = $prd->showProduct();
					if ($prdList) {
						$i = 0;
						while ($result = $prdList->fetch_assoc()) {
				?>
				<tr class="odd gradeX">
					<td><?php echo ++$i ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><?php echo '$'.number_format($result['price']) ?></td>
					<td><img src="uploads/<?php echo $result['image'] ?>" style="height: 100px; image-rendering: pixelated" ></td>
					<td><?php echo $result['catName'] ?></td>
					<td><?php echo $result['brandName'] ?></td>
					<td><?php echo $fm->textShorten($result['productDesc'], 100)  ?></td>
					<td class="center">
						<?php
							if ($result['type'] == 0) {
								echo "Non-Featured";
							} else {
								echo "Featured";
							}
						?>	
					</td>

					<td><a href="productedit.php?productId=<?php echo $result['productId'] ?>">Edit</a> || <a onclick = "return confirm('Are you want to delete???')" href="?productId=<?php echo $result['productId'] ?>">Delete</a></td>
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
