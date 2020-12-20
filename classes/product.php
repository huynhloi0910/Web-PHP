<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/db.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php

	class Product
	{
		private $db;
		private $fm;
		
		public function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}

		//hàm thêm sản phẩm
		public function insertProduct($data, $files) {

			//2 Biến là kết nối csdl và dữ liệu
			//mysqli gọi 2 biến. ($date['productName'] and link) biến link -> gọi conect db từ file db
			//và truyền dl từ $date['productName'] vào
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category    = mysqli_real_escape_string($this->db->link, $data['category']);
			$brand       = mysqli_real_escape_string($this->db->link, $data['brand']);
			$productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
			$price       = mysqli_real_escape_string($this->db->link, $data['price']);
			$type        = mysqli_real_escape_string($this->db->link, $data['type']);

			// kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg','jpeg','png','gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];
			
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;


			if($productName == "" || $category == "" || $brand == "" || $productDesc == "" || $price == "" || $type == "" || $file_name == "") {

				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;

			} else {

				move_uploaded_file($file_temp, $uploaded_image);
				$query  = "INSERT INTO tbl_product(productName,catId,brandId,productDesc,type,price,image) VALUES('$productName','$category','$brand','$productDesc','$type','$price','$unique_image') ";
				$result =  $this->db->insert($query);

				if ($result) {

						$alert = "<span class='success'>Insert Product Successfully</span>";
						return $alert;
					
				} else {

						$alert = "<span class='error'>Insert Product Not Success</span>";
						return $alert;
				}

			}
		}

		//Hàm hiển thị sản phẩm
		public function showProduct() {

			// $query = "SELECT p.*, c.catName, b.brandName
			// 		FROM tbl_product AS p, tbl_category AS c, tbl_brand AS b WHERE p.catId = c.catId AND p.brandId = b.brandId
			// 		ORDER BY p.productId DESC";


			// //Lấy tất cả dl của tbl_product, tbl_category chỉ lấy catName, tbl_brand chỉ lấy brandName với điều kiện...
			$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
					FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
					INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
					ORDER BY tbl_product.productId DESC ";

			$result =  $this->db->select($query);
			return $result;

		}

		//Lấy sản phẩm để hiển thị ra trang productedit
		public function getProductById($productId) {

			$query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
			$result =  $this->db->select($query);
			return $result;

		}

		//Update sản phẩm
		public function updateProduct($data,$files,$productId){
	
			$productName  = mysqli_real_escape_string($this->db->link, $data['productName']);
			$brand        = mysqli_real_escape_string($this->db->link, $data['brand']);
			$category     = mysqli_real_escape_string($this->db->link, $data['category']);
			$productDesc  = mysqli_real_escape_string($this->db->link, $data['productDesc']);
			$price        = mysqli_real_escape_string($this->db->link, $data['price']);
			$type         = mysqli_real_escape_string($this->db->link, $data['type']);

			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;


			if($productName=="" || $brand=="" || $category=="" || $productDesc=="" || $price=="" || $type=="") {

				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert; 

			}else{

				if(!empty($file_name)){

					//Nếu người dùng chọn ảnh
					if ($file_size > 204800) {

			    		 $alert = "<span class='error'>Image Size should be less then 2MB!</span>";
						return $alert;

				    } 

					elseif (in_array($file_ext, $permited) === false) {

					    $alert = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
						return $alert;

					}

					move_uploaded_file($file_temp,$uploaded_image);

					$query = "UPDATE tbl_product SET
							productName = '$productName',
							brandId = '$brand',
							catId = '$category', 
							type = '$type', 
							price = '$price', 
							image = '$unique_image',
							productDesc = '$productDesc'
							WHERE productId = '$productId'";
					
				} else {

					//Nếu người dùng không chọn ảnh
					$query = "UPDATE tbl_product SET
							productName = '$productName',
							brandId = '$brand',
							catId = '$category', 
							type = '$type', 
							price = '$price', 
							productDesc = '$productDesc'
							WHERE productId = '$productId'";
					
				}

				$result = $this->db->update($query);

				if($result){

					$alert = "<span class='success'>Product Updated Successfully</span>";
					return $alert;

				}else{

					$alert = "<span class='error'>Product Updated Not Success</span>";
					return $alert;

				}
				
			}

		}


		//Xóa sản phẩm
		public function delProduct($delId) {

			$query = "DELETE FROM tbl_product WHERE productId = '$delId'";
			$result =  $this->db->delete($query);

			if($result){

					$alert = "<span class='success'>Product Deleted Successfully</span>";
					return $alert;

				} else {

					$alert = "<span class='error'>Product Deleted NOT Success</span>";
					return $alert;

				}
		}

		//END BACKEND ADMIN

		//============================================================

		//START FRONTEND HOME

		//Lấy sản phẩm nổi bật
		public function getFeatureProduct() {
			
			$query = "SELECT * FROM tbl_product WHERE type = '1'";
			$result =  $this->db->select($query);
			return $result;

		}

		//Lấy sản phẩm mới
		public function getNewProduct() {
			
			$query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
			$result =  $this->db->select($query);
			return $result;

		}

		//Lấy all sản phẩm
		public function getAllProduct() {
			
			$query = "SELECT * FROM tbl_product ORDER BY productId DESC";
			$result =  $this->db->select($query);
			return $result;

		}

		//Lấy Page sản phẩm 
		public function getPageProduct() {

			$maxProduct = 4;
			if (!isset($_GET['page'])) {
				$page = 1;
			} else {
				$page = $_GET['page'];
			}

			$pages = ($page - 1) * $maxProduct;
			$query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $pages,$maxProduct ";
			$result =  $this->db->select($query);
			return $result;

		}

		//Lấy chi tiết sản phẩm
		public function getProductDetails($productId) {
			
			$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
					FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
					INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
					WHERE tbl_product.productId = '$productId'";
			$result =  $this->db->select($query);
			return $result;

		}

		public function getLastestDell()
		{
			$query = "SELECT * FROM tbl_product where brandId = '3' and catId = '2' limit 1";
			$result = $this->db->select($query);
			return $result;	
		}

		public function getLastestAsus()
		{
			$query = "SELECT * FROM tbl_product where brandId = '8' and catId = '3' limit 1";
			$result = $this->db->select($query);
			return $result;	
		}

		public function getLastestApple()
		{
			$query = "SELECT * FROM tbl_product where brandId = '3' and catId = '4' limit 1";
			$result = $this->db->select($query);
			return $result;	
		}

		public function getLastestSamsung()
		{
			$query = "SELECT * FROM tbl_product where brandId = '2' and catId = '8' limit 1";
			$result = $this->db->select($query);
			return $result;	
		}


		//Lấy thông tin sản phẩm để đưa vào cart
		public function getProductByIdToCart($productId) {

			$query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
			$result =  $this->db->select($query);
			$value = $result->fetch_assoc();
			return $value;

		}


		//Tìm kiếm sp 
		public function findProduct($key) {

			$query = "SELECT * FROM tbl_product WHERE productName LIKE '%$key%' ORDER BY productId DESC ";
			$result =  $this->db->select($query);
			return $result;

		}

	}
?>