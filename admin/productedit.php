<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/brand.php';  ?> 
<?php include '../classes/product.php';  ?> 

<?php
    //Gọi class Product trong file product.php
    $prd = new Product();

    if (!isset($_GET['productId']) && $_GET['productId'] == NULL) {
        echo "<script> window.location = 'productlist.php' </script>";
    } else {
        $productId = $_GET['productId'];// Lấy catid trên host
    }

    //Lấy dl ở form bằng phương thức post
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateProduct'])) {
        //Lấy tất cả dl khi nhấn submit form và dùng phương thức post để gửi vào $_POST rồi qua hàm insertProduct
        //Gọi hàm insertProduct trong class Product và truyền vào 3 tham số 
        $updateProduct = $prd->updateProduct($_POST, $_FILES, $productId);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Product</h2>
        <div class="block">   
        <?php
            if (isset($updateProduct)) {
                echo $updateProduct;
            }
        ?> 

        <?php 
            $getProductById = $prd->getProductById($productId);
            if ($getProductById) {
                while ($resultProduct = $getProductById->fetch_assoc()) {
        ?>           
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $resultProduct['productName'] ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>-----Select Category-----</option>
                            <?php
                                $cat = new Category();
                                $catList = $cat->showCategory();
                                if ($catList) {
                                    while ($resultCate = $catList->fetch_assoc()) {
                            ?>
                            <option 
                                <?php 
                                    if ($resultCate['catId'] == $resultProduct['catId']) {
                                        echo "selected";
                                    }
                                ?>  
                                value="<?php echo $resultCate['catId'] ?>"><?php echo $resultCate['catName'] ?>
                            </option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>-----Select Brand-----</option>
                            <?php
                                $brand = new Brand();
                                $brandList = $brand->showBrand();
                                if ($brandList) {
                                    while ($resultBrand = $brandList->fetch_assoc()) {
                            ?>
                            <option 
                                <?php
                                    if ($resultBrand['brandId'] == $resultProduct['brandId']) {
                                        echo "selected";
                                    }
                                ?>
                                value="<?php echo $resultBrand['brandId'] ?>"><?php echo $resultBrand['brandName'] ?>
                                
                            </option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                
                 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Short Description</label>
                    </td>
                    <td>
                        <textarea name="productDesc" style="width: 195px;resize: none"><?php echo $resultProduct['productDesc'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $resultProduct['price'] ?>" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <p><img src="uploads/<?php echo $resultProduct['image'] ?>" style="height: 100px; image-rendering: pixelated"></p>
                        <input type="file" name="image" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php
                                if ($resultProduct['type'] == 0) {
                            ?>
                            <option value="1">Featured</option>
                            <option selected value="0">Non-Featured</option>
                            <?php
                                } else {
                            ?>
                            <option selected value="1">Featured</option>
                            <option value="0">Non-Featured</option>
                            <?php

                                   }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="updateProduct" Value="Update" />
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


