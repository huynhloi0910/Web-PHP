<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/db.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php

	class Cart
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}


		//Add to cart 
		public function addToCart($productId, $qty) {

			$qty = $this->fm->validation($qty);
			$qty = mysqli_real_escape_string($this->db->link, $qty);
			$productId = mysqli_real_escape_string($this->db->link, $productId);
			$sId = session_id();
			$query  = "SELECT * FROM tbl_product WHERE productId = '$productId' ";	
			$result = $this->db->select($query)->fetch_assoc();

			$productName = $result['productName'];
			$price = $result['price'];
			$image = $result['image'];
			// echo "<pre>";
			// var_dump( $result['image']);
			// echo "</pre>";

			//Nếu sp đã tồn tại trong giỏ hàng thì 
			$checkCart = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId' " ;
			$resultCheckCart = $this->db->select($checkCart);

			if($resultCheckCart){

				$msg = "<span class='erorr'>Product Already Added ";
				return $msg;

			} else {

				$queryInsert = "INSERT INTO tbl_cart(sId,productId,productName,qty,price,image) VALUES('$sId','$productId','$productName','$qty','$price','$image') ";
				$insertCart = $this->db->insert($queryInsert);

				if($insertCart){
					header('Location:cart.php');
				}else {
					header('Location:404.php');
				}
	
			}
			
		}

		//Show sp ra cart
		public function getProductCart() {

			$sId = session_id();//Check phiên làm việc hiện tại
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
			$result = $this->db->select($query);
			return $result;

		}

		//Update qty cart
		public function updateQty($cartId, $qty) {

			$cartId = mysqli_real_escape_string($this->db->link, $cartId);
			$qty    = mysqli_real_escape_string($this->db->link, $qty);

			$query = "UPDATE tbl_cart SET

				qty = '$qty'

				WHERE cartId = '$cartId'";

			$result = $this->db->update($query);
				if ($result) {
					header('Location:cart.php');
				}else {
					$msg = "<span class='erorr'> Product Quantity Updated NOT Succesfully</span> ";
					return $msg;
				}
		}

		//Delete sp cart
		public function delProductCart($cartId) {

			$cartId = mysqli_real_escape_string($this->db->link, $cartId);
			$query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
			$result = $this->db->delete($query);
			if($result){
				header('Location:cart.php');
			}else{
				$msg = "<span class='error'>Product Cart Deleted Succesfully</span>";
				return $msg;
			}
		}

		//Delete cart khi ng dùng ấn logout
		public function delAllCart() {

			$sId = session_id();
			$query = "DELETE FROM tbl_cart WHERE sId = '$sId' ";
			$result = $this->db->delete($query);
			return $result;

		}


		//Insert order
		public function insertOrder($customerId) {

			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
			$getProduct = $this->db->select($query);

			if($getProduct){

				while($result = $getProduct->fetch_assoc()){
					$customerId = $customerId;
					$productId = $result['productId'];
					$productName = $result['productName'];
					$qty = $result['qty'];
					$price = $result['price'] * $qty;
					$image = $result['image'];
					$queryOrder = "INSERT INTO tbl_order(customerId,productId,productName,qty,price,image) VALUES('$customerId','$productId','$productName','$qty','$price','$image')";
					$insertOrder = $this->db->insert($queryOrder);

				}
			}
		}

		//Lấy total price của order để hiện tổng giá trang success
		public function getAmountPrice($customerId) {

			$query = "SELECT price FROM tbl_order WHERE customerId = '$customerId' ";
			$result = $this->db->select($query);
			return $result;

		}

		//Lấy thông tin tb_oder để hiện trong trang orderdetails
		public function getOder ($customerId) {

			$query = "SELECT * FROM tbl_order WHERE customerId = '$customerId' ORDER BY dateOrder DESC ";
			$result = $this->db->select($query);
			return $result;
		}


		//Lấy tất cả oder hiển thị ra Oder indox trong admin
		public function getAllOrder() {

			$query = "SELECT * FROM tbl_order ORDER BY dateOrder DESC ";
			$result = $this->db->select($query);
			return $result;

		}


		//updateStatusOrder
		public function shifted($id,$time,$price) {

			$id     = mysqli_real_escape_string($this->db->link, $id);
			$time   = mysqli_real_escape_string($this->db->link, $time);
			$price  = mysqli_real_escape_string($this->db->link, $price);

			$query  = "UPDATE tbl_order SET status = '1' WHERE id = '$id' AND dateOrder = '$time' AND price = '$price' ";
			$result = $this->db->update($query);

			if($result){

				$alert = "<span class='success'>Status Order Updated Successfully</span>";
				return $alert;

			} else {

				$alert = "<span class='error'>Status Order Updated Not Success</span>";
				return $alert;

			}

		}

		//Khi ng dùng đã nhận sp thì Admin sẽ xóa đơn hàng 
		public function del_shifted($id,$time,$price){

			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$query = "DELETE FROM tbl_order WHERE id = '$id' AND dateOrder = '$time' AND price = '$price' ";

			$result = $this->db->delete($query);
			if ($result) {
				$msg = "<span class='success'> DELETE Order Succesfully</span> ";
				return $msg;
			}else {
				$msg = "<span class='error'> DELETE Order NOT Succesfully</span> ";
				return $msg;
			}
		}


		public function shifted_confirm($id,$time,$price)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$query = "UPDATE tbl_order SET status = '2' WHERE customerId = '$id' AND dateOrder = '$time' AND price = '$price' ";
			$result = $this->db->update($query);
			return $result;
		}

	}
?>