<?php
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../lib/session.php');
	//Gọi hàm check login trong file session.php để kiểm tra session
	Session::checkLogin(); 
	include_once($filepath.'/../lib/db.php');
	include_once($filepath.'/../helpers/format.php');
?>

<?php

	class Adminlogin
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		//hàm check User and Pass khi submit lên
		public function loginAdmin($adminUser, $adminPass) {

			//Gọi ham validation từ class Format để kiểm tra
			$adminUser = $this->fm->validation($adminUser);
			$adminPass = $this->fm->validation($adminPass);

			//2 biến là kết nối csdl và dữ liệu
			$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
			$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

			if (empty($adminUser) || empty($adminPass)) {

				$alert = "<span class='error'>User and Pass must be not empty</span>";;
				return $alert;

			} else {

				$query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' ";
				$result =  $this->db->select($query);

				if ($result) {

					//Lấy kết quả
					$value = $result->fetch_assoc();
					//true: đã tồn tại adminlogin này rồi, phiên đăng nhập này có tên là adminlogin  
					Session::set('adminlogin', true);
					Session::set('adminId', $value['adminId']);
					Session::set('adminUser', $value['adminUser']);
					Session::set('adminName', $value['adminName']);
					header('Location:index.php');

				} else {

					$alert = "<span class='error'>User and Pass not match</span>";
					return $alert;

				}
			}
		}
	}
?>