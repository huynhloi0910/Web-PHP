<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/customer.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
    $cur = new Customer();
    if (!isset($_GET['customerId']) && $_GET['customerId'] == NULL) {
        echo "<script> window.location = 'inbox.php' </script>";
    } else {
        $customerId = $_GET['customerId'];// Lấy customerId trên host
    }
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Profile Customer</h2>
       <div class="block copyblock"> 
        <?php
            $getCustomerById = $cur->getCustomerById($customerId);
            if ($getCustomerById) {
                while ($result = $getCustomerById->fetch_assoc()) {
        ?>
         <form action="" method="post">
            <table class="form">                    
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><input type="text" name="name" value="<?php echo $result['name']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input type="email" name="email" value="<?php echo $result['email']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><input type="text" name="address" value="<?php echo $result['address']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><input type="text" name="phone" value="<?php echo $result['phone']; ?>"></td>
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