<?php
	//Gọi file adminlogin
	include '../classes/adminlogin.php';
?>
<?php
	//Gọi class Adminlogin trong file adminlogin.php
	$ad = new Adminlogin();
	//Lấy dl ở form bằng phương thức post
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$adminUser = $_POST['adminUser'];
		$adminPass = md5($_POST['adminPass']);
		//Gọi hàm loginAmind trong class Adminlogin và truyền vào 2 tham số 
		$loginCheck = $ad->loginAdmin($adminUser, $adminPass);
	}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span>
				<?php
					if (isset($loginCheck)) {
						echo $loginCheck;
					}
				?>
			</span>
			<div>
				<input type="text" placeholder="Username" required="" name="adminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Well come to login</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>