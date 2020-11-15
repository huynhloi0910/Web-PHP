<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php
    //Gọi class Brand trong file brand.php
    $brand = new Brand();
    //Lấy dl ở form bằng phương thức post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $brandName = $_POST['brandName'];
        //Gọi hàm insertBrand trong class Brand và truyền vào 1 tham số 
        $insertBrand = $brand->insertBrand($brandName);

    }
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Brand</h2>
       <div class="block copyblock"> 
        <?php
            if (isset($insertBrand)) {
                echo $insertBrand;
            }
        ?>
         <form action="brandadd.php" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="brandName" placeholder="Add Brand..." class="medium" />
                    </td>
                </tr>
				<tr> 
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php';?>