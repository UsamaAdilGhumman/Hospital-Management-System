<!DOCTYPE html>
<html>
<head>
	<title>Manage Profile</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">
	body
	{
		background-image: url('../SignUp/PatientSignUp.jpg');
		position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
	input,select{
		border-radius: 50px;
		width: 300px;
	}
	button{
		width: 100px;
		margin-left: 40px;
		border-radius: 50px;
	}
	textarea{
		width: 300px;
	}
</style>
</head>
<body>
	<div class="bg-img">
<div style="margin-top: 10px; margin-left: 100px; background: url('../SignUp/doctorformbg.png'); width: 400px; height: 520px;
  opacity: 0.7; border-radius: 50px;">
	<h3 style="background-color: #87CEEB; padding-left: 100px; padding-top: 30px;padding-bottom: 30px;">Patient Profile</h3>
	<?php
	require_once '../LoginPage/config.php';
	session_start();
	$id = $_SESSION['id'];
    $q = "Select * from patient where patient_id = '{$id}'";
	$result1 = mysqli_query($mysqli,$q) or die('Wrong Query');
	if(mysqli_num_rows($result1)>0)
	{
		while ($row1 = mysqli_fetch_assoc($result1)) {
	 ?>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="padding-left: 50px;">
	
        <label>Full Name:</label><br>
		<input type="text" name="name" value="<?php echo $row1['patient_name'] ?>" readonly><br><br>
		<label>Mobile:</label><br>
		<input type="phone" name="mobile" value="<?php echo $row1['patient_mobile'] ?>" pattern="[0-9]{4}-[0-9]{7}" placeholder="xxxx-xxxxxxx" readonly><br><br>
		<label>Email:</label><br>
		<input type="Email" name="email" value="<?php echo $row1['patient_email'] ?>" readonly><br><br>
		<label>Address:</label><br>
		<textarea rows="2",cols="40" style="margin-left: 0px" name="address" readonly><?php echo $row1['patient_address'] ?></textarea><br><br>
	</form>
	     <?php }
}
?>
</div>
</div>
</body>
</html>