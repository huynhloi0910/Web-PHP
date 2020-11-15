<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php
    //Gọi class Brand trong file Brand.php
    $brand = new Brand();
    if (!isset($_GET['brandId']) && $_GET['brandId'] == NULL) {
        echo "<script> window.location = 'brandlist.php' </script>";
    } else {
        $brandId = $_GET['brandId'];// Lấy brandId trên host
    }

    //Lấy dl ở form bằng phương thức post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $brandName = $_POST['brandName'];
        //Gọi hàm updateBrand trong class Brand và truyền vào 2 tham số 
        $updateBrand = $brand->updateBrand($brandName, $brandId);

    }

?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Brand</h2>
       <div class="block copyblock"> 
        <?php
            if (isset($updateBrand)) {
                echo $updateBrand;
            }
        ?>
        <?php
            $getBrandName = $brand->getBrandById($brandId);
            if ($getBrandName) {
                while ($result = $getBrandName->fetch_assoc()) {
        ?>
         <form action="" method="post">
            <table class="form">                    
                <tr>
                    <td>
                        <input type="text" value="<?php echo $result['brandName']  ?>" name="brandName" placeholder="Edit Brand..." class="medium" />
                    </td>
                </tr>
                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        <?php
                }
            }
        ?>
        </div>
    </div>
</div>

<?php include 'inc/footer.php';?>