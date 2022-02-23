<?php
require_once "config.php";
$email = $password = "";
$error = "";
if(isset($_POST['Login']))
{
	$sql = "Select * from admin";
	$result = mysqli_query($mysqli,$sql);
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_assoc($result))
	    {
		if($row['email'] == $_POST['email'] && $row['password'] == $_POST['password'])
		{
			header("location: http://localhost/HMS/ADashboard/ ");
		}
		else
		{
			$error = "Invalid Email And Password";
		}
	    }
	}
}
mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">
body
{
	background-image: url("Admin bg.jpg");
	background-repeat: no-repeat;
	background-size: cover;
}
input{
	width: 230px;
	border-radius: 50px;
}
button{
	border-radius: 50px;
	width: 100px;
	margin-left: 10px;
}
</style>
</head>
<br>
<br>
<body>
	<div style="width: 300px; height: 380px; border-radius: 50px; background-color: #C0C0C0; margin-left: 500px;"><br>
	<h3 style=" padding-left: 40px; margin-top: 40px; border-radius: 20px 20px 0px 0px; ">Admin Login</h3><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="padding-left: 30px;">
<label>Email:</label><br>
<input type="email" name="email"><br><br>
<label>Password:</label><br>
<input type="Password" name="password"><br><?php echo $error ?><br>
<button type="submit" value="Login" name="Login">Login</button>
<button type="reset" value="Reset">Reset</button>
</form>
</div>
</body>
</html>