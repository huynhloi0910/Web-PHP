<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/db.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php

	class Slider
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		//Insert slider
		public function insertSlider($data,$files) {

			$sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
			$type       = mysqli_real_escape_string($this->db->link, $data['type']);			

			// kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;


			// echo "<pre>";
			// var_dump($data);
			// echo "</prev>";
			// echo $unique_image;

			if($sliderName=="" || $file_size == 0 || $type == 3){

				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;

			} else {

				if(!empty($file_name)){
					//Nếu chọn ảnh
					if ($file_size > 2048000) {

			    		$alert = "<span class='error'>Image Size should be less then 2MB!</span>";
						return $alert;

				    } 

					elseif (in_array($file_ext, $permited) === false) {

				    	$alert = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
						return $alert;

					}

					move_uploaded_file($file_temp,$uploaded_image);
					
					$query = "INSERT INTO tbl_slider(sliderName, sliderImage, type) VALUES('$sliderName','$unique_image','$type') ";
					$result = $this->db->insert($query);

					if($result) {

						$alert = "<span class='success'>Slider Added Successfully</span>";
						return $alert;

					} else {

						$alert = "<span class='error'>Slider Added NOT Success</span>";
						return $alert;

					}
				}
				
				
			}

		}

		//Show slider On
		public function showSlider () {

			$query = "SELECT * FROM tbl_slider WHERE type = '1' ORDER BY sliderId DESC ";
			$result = $this->db->select($query);
			return $result;
			
		}

		//Show All slider
		public function showAllSlider () {

			$query = "SELECT * FROM tbl_slider ORDER BY sliderId DESC ";
			$result = $this->db->select($query);
			return $result;
			
		}

		//Update type slider 
		public function updateType($sliderId, $type) {

			$type   = mysqli_real_escape_string($this->db->link, $type);	
			$query  = "UPDATE tbl_slider SET type = '$type' WHERE sliderId = '$sliderId' ";
			$result = $this->db->update($query);
			return $result;
		}

		//Xóa slider 
		public function delSlider($sliderId) {
			
			$query = "DELETE FROM tbl_slider WHERE sliderId = '$sliderId' ";
			$result = $this->db->delete($query);
			if ($result) {

						$alert = "<span class='success'>Slider Deleted Successfully</span>";
						return $alert;
					
				} else {

						$alert = "<span class='error'>Slider Deleted Success</span>";
						return $alert;
			}

		}
	}
?>