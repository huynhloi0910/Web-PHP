<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/db.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php

	class Brand
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		//hàm thêm thương hiệu
		public function insertBrand($brandName) {

			//Gọi ham validation từ class Format để kiểm tra
			$brandName = $this->fm->validation($brandName);

			//2 Biến là kết nối csdl và dữ liệu
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);


			if (empty($brandName)) {

				$alert = "<span class='error'>Brand must be not empty</span>";
				return $alert;

			} else {

				$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName') ";
				$result =  $this->db->insert($query);

				if ($result) {

						$alert = "<span class='success'>Insert Brand Successfully</span>";
						return $alert;
					
				} else {

						$alert = "<span class='error'>Insert Brand Not Success</span>";
						return $alert;
				}

			}
		}

		//Hàm hiển thị thương hiệu
		public function showBrand() {

			$query = "SELECT * FROM tbl_brand ORDER BY  brandId DESC";
			$result =  $this->db->select($query);
			return $result;

		}

		//Lấy thương hiệu để hiển thị ra trang brandedit
		public function getBrandById($brandId) {

			$query = "SELECT * FROM tbl_brand WHERE brandId = '$brandId'";
			$result =  $this->db->select($query);
			return $result;

		}

		//Update tên thương hiệu
		public function updateBrand($brandName, $brandId) {

			//Gọi ham validation từ class Format để kiểm tra
			$brandName = $this->fm->validation($brandName);
			$brandId = $this->fm->validation($brandId);


			//2 Biến là kết nối csdl và dữ liệu
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$brandId = mysqli_real_escape_string($this->db->link, $brandId);


			if (empty($brandName)) {

				$alert = "<span class='error'>Brand must be not empty</span>";
				return $alert;

			} else {

				$query = "UPDATE tbl_brand SET brandName= '$brandName' WHERE brandId = '$brandId' ";
				$result = $this->db->update($query);

				if($result){

					$alert = "<span class='success'>Brand Update Successfully</span>";
					return $alert;

				}else {

					$alert = "<span class='error'>Update Brand NOT Success</span>";
					return $alert;

				}

			}
		}


		//Xóa thương hiệu 
		public function delBrand($delId) {

			$query = "DELETE FROM tbl_brand WHERE brandId = '$delId'";
			$result =  $this->db->delete($query);

			if($result){

					$alert = "<span class='success'>Brand Deleted Successfully</span>";
					return $alert;

				}else {

					$alert = "<span class='error'>Brand Deleted NOT Success</span>";
					return $alert;

				}

		}
	}
?>