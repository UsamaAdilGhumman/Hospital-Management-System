<?php
$name=$mobile=$email=$address=$password="";
$name_err=$mobile_err=$email_err=$address_err="";
if (isset($_POST['update'])) {
	require_once 'config.php';
	$input_id = $_POST['p_id'];
	 $input_name = trim($_POST['name']);
	 $input_mobile = trim($_POST['mobile']);
	 $input_email = trim($_POST['email']);
	 $input_address = trim($_POST['address']);
	  if(empty($input_mobile))
	 {
	 	$mobile_err = "Please Enter Mobile Number"; 
	 }else{
	 	$mobile = $input_mobile;
	 }
	 if(empty($input_email))
	{
	 	$email_err = "Please Enter Email";
	}else
	{
	$query = "select patient_email from patient where patient_email = '{$input_email}'";
    $result1 = mysqli_query($mysqli,$query) or die("Email query wrong");
    if(mysqli_num_rows($result1) == 1)
    {
    	$email_err = "Already Use Email";
    }else{
	 	$email =$input_email;
	}
    }
	 if(empty($input_name))
	 {
	 	$name_err = "Please Enter Name";
	 }elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    if(empty($input_address)){
    	$address_err = "Please Enter Address";
    }else{
    	$address = $input_address;
    }
	 $q = "Update patient set patient_name = '{$name}',patient_email = '{$email}',patient_mobile = '{$mobile}',patient_address='{$address}' where patient_id = '{$input_id}'";
    	 mysqli_query($mysqli,$q) or die('Wrong Update Query');
    	 mysqli_close($mysqli);
    	header("Location: http://localhost/HMS/ADashboard/ManagePatient.php");
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Doctor</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">
	body
	{
		background-image: url('PatientEdit.jpg');
		position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
	input,select {
		border-radius: 50px;
		width: 300px;
	}
	button{
		width: 200px;
		margin-left: 30px;
		border-radius: 50px;
	}
	textarea{
		width: 300px;
	}
</style>
</head>
<body style="opacity: 0.7">
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.html">Hospital Management System</a>
    </div>
      <div class="navbar-header" style="float: right;">
        <a class="navbar-brand" href="logout.php" >Log Out</a>
      </div>
  </div>
</nav>
<div style="background-color: silver; width: 370px; height: 500px; padding-left: 20px; padding-top: 2px;">
	<h2>Edit Patient Information</h2>
	<?php 
	require_once 'config.php';
	$id = $_GET['id'];
	$sql = "Select * from Patient where patient_id = '{$id}'";
	$result = mysqli_query($mysqli,$sql) or die('Wrong Select Query');
	if(mysqli_num_rows($result)>0)
	{
		while ($row = mysqli_fetch_assoc($result)) {
	?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<input type="hidden" name="p_id" value="<?php echo $row['patient_id']?>">
		<label>Full Name:</label><br>
		<input type="text" name="name" value="<?php echo $row['patient_name'] ?>"><br><?php echo $name_err ?><br>
		<label>Mobile:</label><br>
		<input type="phone" name="mobile" value="<?php echo $row['patient_mobile'] ?>"><br><?php echo $mobile_err ?><br>
		<label>Email:</label><br>
		<input type="Email" name="email" value="<?php echo $row['patient_email'] ?>"><br><?php echo $email_err ?><br>
		<label>Address:</label><br>
		<textarea rows="2",cols="40" style="margin-left: 0px" name="address"><?php echo $row['patient_address'] ?></textarea><br><?php echo $address_err ?><br>
         <button type="submit" value="Update" name="update">Update</button>
	</form>
    <?php } } ?>
</div>
</body>
</html>