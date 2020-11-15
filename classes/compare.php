<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/db.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php

	class Compare
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		//Insert sản phẩm vào compare
		public function insertCompare($productId, $customerId) {

			$productId  = mysqli_real_escape_string($this->db->link, $productId);
			$customerId  = mysqli_real_escape_string($this->db->link, $customerId);

			//Nếu sản phẩm đã được thêm vào compare thì 
			$checkCompare  = "SELECT * FROM tbl_compare WHERE productId = '$productId' AND customerId = '$customerId' ";
			$resultcheckCompare = $this->db->select($checkCompare);

			if ($resultcheckCompare) {

				$mgs = "<span class='error'>Product Already to Compare</span>";
				return $mgs;

			} else {

				//Lấy dl của sản phẩm để thêm vào tbl_compare
				$queryGetProduct  = "SELECT * FROM tbl_product WHERE productId = '$productId'";
				$resultGetProduct = $this->db->select($queryGetProduct)->fetch_assoc();

				$productName = $resultGetProduct['productName'];
				$price 	  	 = $resultGetProduct['price'];
				$image 		 = $resultGetProduct['image'];


				$queryInsertCompare  = "INSERT INTO tbl_compare(customerId, productId, productName, price, image) VALUES ('$customerId', '$productId', '$productName', '$price', '$image') ";
				$resultInsertCompare = $this->db->insert($queryInsertCompare);

				if($resultInsertCompare){

					$alert = "<span class='success'>Added Compare Successfully</span>";
					return $alert;

				}else{

					$alert = "<span class='error'>Added Compare Not Success</span>";
					return $alert;

				}

			}
		}

		//Show sản phẩm compare
		public function getCompare($customerId) {

			$query = "SELECT * FROM tbl_compare WHERE customerId = '$customerId' ORDER BY id DESC ";
			$result =  $this->db->select($query);
			return $result;

		}


		//Khi người dùng nhấn logout thì delete danh sách compare của người dùng đó
		public function delCompare ($customerId) {

			$query = "DELETE FROM tbl_compare WHERE customerId = '$customerId' ";
			$result =  $this->db->delete($query);
			return $result;

		}

		//Insert sản phẩm vào Wishlist
		public function insertWhislist($productId, $customerId) {

			$productId  = mysqli_real_escape_string($this->db->link, $productId);
			$customerId  = mysqli_real_escape_string($this->db->link, $customerId);

			//Nếu sản phẩm đã được thêm vào Wishlist thì 
			$checkWishlist  = "SELECT * FROM tbl_wishlist WHERE productId = '$productId' AND customerId = '$customerId' ";
			$resultcheckWishlist = $this->db->select($checkWishlist);

			if ($resultcheckWishlist) {

				$mgs = "<span class='error'>Product Already to Wishlist</span>";
				return $mgs;

			} else {

				//Lấy dl của sản phẩm để thêm vào tbl_wishlist
				$queryGetProduct  = "SELECT * FROM tbl_product WHERE productId = '$productId'";
				$resultGetProduct = $this->db->select($queryGetProduct)->fetch_assoc();

				$productName = $resultGetProduct['productName'];
				$price 	  	 = $resultGetProduct['price'];
				$image 		 = $resultGetProduct['image'];


				$queryInsertWishlist  = "INSERT INTO tbl_wishlist(customerId, productId, productName, price, image) VALUES ('$customerId', '$productId', '$productName', '$price', '$image') ";
				$resultInsertWishlist = $this->db->insert($queryInsertWishlist);

				if($resultInsertWishlist){

					$alert = "<span class='success'>Added Wishlist Successfully</span>";
					return $alert;

				}else{

					$alert = "<span class='error'>Added Wishlist Not Success</span>";
					return $alert;

				}

			}
		}

		//Show sản phẩm Wishlist
		public function getWishlist ($customerId) {

			$query = "SELECT * FROM tbl_wishlist WHERE customerId = '$customerId' ORDER BY id DESC ";
			$result =  $this->db->select($query);
			return $result;

		}

		//Khi người dùng nhấn Remove Wishlist
		public function delWishlist($productId, $customerId) {

			$query = "DELETE FROM tbl_wishlist WHERE customerId = '$customerId' AND productId = '$productId' ";
			$result =  $this->db->delete($query);
			return $result;

		}

		//Khi người dùng nhấn logout thì delete danh sách wishlist của người dùng đó
		public function delAllWishlist ($customerId) {

			$query = "DELETE FROM tbl_wishlist WHERE customerId = '$customerId' ";
			$result =  $this->db->delete($query);
			return $result;

		}

	}
?>