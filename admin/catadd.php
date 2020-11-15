<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
    //Gọi class Category trong file category.php
    $cat = new Category();
    //Lấy dl ở form bằng phương thức post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $catName = $_POST['catName'];
        //Gọi hàm insertCategory trong class Category và truyền vào 1 tham số 
        $insertCat = $cat->insertCategory($catName);

    }
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Category</h2>
       <div class="block copyblock"> 
        <?php
            if (isset($insertCat)) {
                echo $insertCat;
            }
        ?>
         <form action="catadd.php" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="catName" placeholder="Add Category..." class="medium" />
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