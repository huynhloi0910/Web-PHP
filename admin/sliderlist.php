<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/slider.php';?>
<?php
	$slr = new Slider();
	//Đổi type slider
	if (isset($_GET['typeSlider']) && isset($_GET['type'])) {
		$sliderId   = $_GET['typeSlider'];
		$type       = $_GET['type'];
		$updateType = $slr->updateType($sliderId, $type);
	}

	//Xóa slider
	if (isset($_GET['delSlider'])) {
		$sliderId   = $_GET['delSlider'];
		echo $sliderId;
		$delSlider = $slr->delSlider($sliderId);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block"> 
        <?php
        	if (isset($delSlider)) {
        		echo $delSlider;
        	}
        ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Name</th>
					<th>Slider Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$slr = new Slider();
				$showAllSlider = $slr->showAllSlider();
				if($showAllSlider) {
					$i = 0;
					while ($result = $showAllSlider->fetch_assoc()) {
						$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['sliderName'] ?></td>
					<td><img src="uploads/<?php echo $result['sliderImage'] ?>" style="height: 120px;width: 500px;image-rendering: pixelated"  height="40px" width="60px"/></td>
					<td>
					<?php 
						if ($result['type'] == 1) {
					?>
						<a href="?typeSlider=<?php echo $result['sliderId'] ?>&type=0">Off</a>
					<?php
						 }else {
					?>		
							<a href="?typeSlider=<?php echo $result['sliderId'] ?>&type=1">On</a>
					<?php
						}
					?>
					</td>			
				<td>
					<a href="?delSlider=<?php echo $result['sliderId'] ?>" onclick="return confirm('Are you sure to Delete!');" >Delete</a> 
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
