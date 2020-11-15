<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
    //Gọi class Category trong file category.php
    $cat = new Category();
    if(isset($_GET['delId'])){  
        $delId = $_GET['delId']; // Lấy delId trên host
        $delCat = $cat -> delCategory($delId); // hàm check delete Name khi submit lên
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <div class="block">   
        <?php 
            if(isset($delCat)){
                echo $delCat;
            }
         ?>     
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					//Vào lớp Category thông qua $cat và lấy dl từ hàm showCategory
					$showCate = $cat->showCategory();
					if ($showCate) {
						$i = 0;
						while ($result = $showCate->fetch_assoc()) {
							
				?>
				<tr class="odd gradeX">
					<td><?php echo ++$i ?></td>
					<td><?php echo $result['catName']?></td>
					<td><a href="catedit.php?catId=<?php echo $result['catId']?>">Edit</a> || <a  onclick = "return confirm('Are you want to delete???')" href="?delId=<?php echo $result['catId']?>">Delete</a></td>
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

