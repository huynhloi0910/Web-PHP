﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/brand.php';  ?> 
<?php include '../classes/product.php';  ?> 

<?php
    //Gọi class Product trong file product.php
    $prd = new Product();
    //Lấy dl ở form bằng phương thức post
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addProduct'])) {
        //Lấy tất cả dl khi nhấn submit form và dùng phương thức post để gửi vào $_POST rồi qua hàm insertProduct
        //Gọi hàm insertProduct trong class Product và truyền vào 2 tham số 
        $insertProduct = $prd->insertProduct($_POST, $_FILES);

    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">   
        <?php
            if (isset($insertProduct)) {
                echo $insertProduct;
            }
        ?>            
         <form action="productadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" placeholder="Enter Product Name..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option value="3">-----Select Category-----</option>
                            <?php
                                $cat = new Category();
                                $catList = $cat->showCategory();
                                if ($catList) {
                                    while ($result = $catList->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
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
                            <option value="3">-----Select Brand-----</option>
                            <?php
                                $brand = new Brand();
                                $brandList = $brand->showBrand();
                                if ($brandList) {
                                    while ($result = $brandList->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
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
                        <textarea name="productDesc" style="width: 195px;resize: none" placeholder="Enter Short description..."></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option value="3">Select Type</option>
                            <option value="1">Featured</option>
                            <option value="0">Non-Featured</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="addProduct" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
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


