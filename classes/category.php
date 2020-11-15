<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/db.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php

	class Category
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		//hàm thêm danh mục
		public function insertCategory($catName) {

			//Gọi ham validation từ class Format để kiểm tra
			$catName = $this->fm->validation($catName);

			//2 Biến là kết nối csdl và dữ liệu
			$catName = mysqli_real_escape_string($this->db->link, $catName);


			if (empty($catName)) {

				$alert = "<span class='error'>Category must be not empty</span>";
				return $alert;

			} else {

				$query = "INSERT INTO tbl_category(catName) VALUES('$catName') ";
				$result =  $this->db->insert($query);

				if ($result) {

						$alert = "<span class='success'>Insert Category Successfully</span>";
						return $alert;
					
				} else {

						$alert = "<span class='error'>Insert Category Not Success</span>";
						return $alert;
				}

			}
		}

		//Hàm hiển thị danh mục
		public function showCategory() {

			$query = "SELECT * FROM tbl_category ORDER BY catId DESC";
			$result =  $this->db->select($query);
			return $result;

		}

		//Lấy danh mục để hiển thị ra trang editcate
		public function getCateById($catId) {

			$query = "SELECT * FROM tbl_category WHERE catId = '$catId'";
			$result =  $this->db->select($query);
			return $result;

		}

		//Update tên danh mục
		public function updateCategory($catName, $catId) {

			//Gọi ham validation từ class Format để kiểm tra
			$catName = $this->fm->validation($catName);
			$catId = $this->fm->validation($catId);


			//2 Biến là kết nối csdl và dữ liệu
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$catId = mysqli_real_escape_string($this->db->link, $catId);


			if (empty($catName)) {

				$alert = "<span class='error'>Category must be not empty</span>";
				return $alert;

			} else {

				$query = "UPDATE tbl_category SET catName= '$catName' WHERE catId = '$catId' ";
				$result = $this->db->update($query);

				if($result){

					$alert = "<span class='success'>Category Update Successfully</span>";
					return $alert;

				}else {

					$alert = "<span class='error'>Update Category NOT Success</span>";
					return $alert;

				}

			}
		}

		//Xóa danh mục 
		public function delCategory($delId) {

			$query = "DELETE FROM tbl_category WHERE catId = '$delId'";
			$result =  $this->db->delete($query);

			if($result){

					$alert = "<span class='success'>Category Deleted Successfully</span>";
					return $alert;

				}else {

					$alert = "<span class='error'>Category Deleted NOT Success</span>";
					return $alert;

				}

		}

		//END BACKEND ADMIN

		//============================================================

		//START FRONTEND HOME

		//Lấy sản phẩm hiển thị trong danh mục
		public function getProductByCat($catId) {

			$query = "SELECT * FROM tbl_product WHERE catId = '$catId' ORDER BY productId DESC LIMIT 8";
			$result =  $this->db->select($query);
			return $result;

		}
	}
?>