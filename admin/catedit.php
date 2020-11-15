<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
    //Gọi class Category trong file category.php
    $cat = new Category();
    if (!isset($_GET['catId']) && $_GET['catId'] == NULL) {
        echo "<script> window.location = 'catlist.php' </script>";
    } else {
        $catId = $_GET['catId'];// Lấy catid trên host
    }

    //Lấy dl ở form bằng phương thức post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $catName = $_POST['catName'];
        //Gọi hàm updateCategory trong class Category và truyền vào 2 tham số 
        $updateCat = $cat->updateCategory($catName, $catId);

    }

?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Category</h2>
       <div class="block copyblock"> 
        <?php
            if (isset($updateCat)) {
                echo $updateCat;
            }
        ?>
        <?php
            $getCateName = $cat->getCateById($catId);
            if ($getCateName) {
                while ($result = $getCateName->fetch_assoc()) {
        ?>
         <form action="" method="post">
            <table class="form">                    
                <tr>
                    <td>
                        <input type="text" value="<?php echo $result['catName']  ?>" name="catName" placeholder="Edit Category..." class="medium" />
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