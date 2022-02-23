<?php
require_once "config.php";
$email = $password = ""; $row="";
$error = ""; $bool = false;
if(isset($_POST['login']))
{
	$sql = "Select * from Patient";
	$result = mysqli_query($mysqli,$sql);
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_assoc($result)) {
		   if($row['patient_email'] == $_POST['email'] && $row['patient_password'] == $_POST['password'])
		   {
			  $bool = true;
			  break;
		   }
	    }
	    if($bool == true)	
	    {   session_start();
	        $_SESSION['id'] = $row['patient_id'];
	    	header("location: http://localhost/HMS/PDashboard/ ");
	    }else
	    {
		    $error = "Invalid Email And Password";
	    }

	}else
	{
		$error = "Invalid Email And Password";
	}
}
mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Patient Login</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">
body
{
	background-image: url("PatientLogin.jpg");
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
<body>
		<div style="width: 300px; height: 380px; border-radius: 50px; background-color: #C0C0C0; margin-left: 900px; margin-top: 100px;"><br>
	<h3 style=" padding-left: 40px; margin-top: 40px; border-radius: 20px 20px 0px 0px; ">Patient Login</h3><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="padding-left: 30px;">
<label>Email:</label><br>
<input type="email" name="email"><br><br>
<label>Password:</label><br>
<input type="Password" name="password"><br><?php echo $error ?><br>
<button type="submit" value="login" name="login">Login</button>
<button type="reset" value="Reset">Reset</button><br><br>
<a href="../SignUp/Patient.php"><label>Create An Account</label></a>
</form>
</body>
</html>