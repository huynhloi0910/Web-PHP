<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/db.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php

	class Customer
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		//Insert customer
		public function insertCustomer ($data) {

			$name     = mysqli_real_escape_string($this->db->link, $data['name']);
			$email    = mysqli_real_escape_string($this->db->link, $data['email']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			$address  = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone    = mysqli_real_escape_string($this->db->link, $data['phone']);

			if($name == "" || $email == "" || $password == "" || $address == "" || $phone == "") {

				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;

			} else {

				$checkEmail  	  = "SELECT * FROM tbl_customer WHERE email = '$email'";
				$resultCheckEmail =  $this->db->select($checkEmail);
				if ($resultCheckEmail) {
					$alert = "<span class='error'>Email Already Existed ! Please Enter Another Email</span>";
					return $alert;
				} else {

					$query  = "INSERT INTO tbl_customer(name,email,password,address,phone) VALUES('$name','$email','$password','$address','$phone') ";
					$result =  $this->db->insert($query);

					if ($result) {

							$alert = "<span class='success'>Customer Created Successfully</span>";
							return $alert;
						
					} else {

							$alert = "<span class='error'>Customer Created Not Success</span>";
							return $alert;
					}

				}
			}
		}

		//Login customer
		public function loginCustomer ($data) {

			$email    = mysqli_real_escape_string($this->db->link, $data['emailLogin']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['passwordLogin']));


			if($email == "" || $password == "" ) {

				$alert = "<span class='error'>Email and Password must be not empty</span>";
				return $alert;

			} else {

				$query  = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
				$result =  $this->db->select($query);

				if ($result) {

					$value = $result->fetch_assoc();
					Session::set('customerLogin', true);
					Session::set('customerId', $value['id']);
					Session::set('customerName', $value['name']);
					header('Location: order.php');

				} else {

					$alert = "<span class='error'>Email or Password does not match</span>";
					return $alert;

				}
			}
		}

		//Lấy dl customer để update profile
		public function getCustomerById ($customerId) {

			$query = "SELECT * FROM tbl_customer WHERE id = '$customerId'";
			$result =  $this->db->select($query);
			return $result;
		}


		//Update Profile 
		public function updateProfile($data, $customerId) {

			$name     = mysqli_real_escape_string($this->db->link, $data['name']);
			$email    = mysqli_real_escape_string($this->db->link, $data['email']);
			$address  = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone    = mysqli_real_escape_string($this->db->link, $data['phone']);

			if($name == "" || $email == "" || $address == "" || $phone == "") {

				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;

			} else {

				$query  = "UPDATE tbl_customer SET name = '$name', email = '$email', address = '$address', phone = '$phone' WHERE id = '$customerId' ";
				$result =  $this->db->update($query);
				if ($result) {

						$alert = "<span class='success'>Customer Updated Successfully</span>";
						return $alert;
					
				} else {

						$alert = "<span class='error'>Customer Updated Not Success</span>";
						return $alert;
				}

			}
		}


	}
?>