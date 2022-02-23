<?php 
require_once 'config.php';
$name=$Specialist=$fee=$mobile=$email=$gender=$address=$password="";
$name_err=$Specialist_err=$fee_err=$mobile_err=$email_err=$gender_err=$address_err=$password_err="";
if(isset($_POST['signup']))
{
	 $input_name = trim($_POST['name']);
	 $input_specialist = trim($_POST['Specialist']);
	 $input_fee = trim($_POST['fee']);
	 $input_mobile = trim($_POST['mobile']);
	 $input_email = trim($_POST['email']);
	 if(isset($_POST['gender']))
	 $input_gender = trim($_POST['gender']);
	 $input_address = trim($_POST['address']);
	 if($_POST['password']==$_POST['conpassword'])
	 {
	 	$input_password = trim($_POST['password']);
	 }
	 else
	 {
	 	$password_err = "No Match Password";
	 }
	 if(empty($input_password))
	 {
	 	$password_err = "Please Enter password";
	 }else{
	 	$password = $input_password;
	 }
	  if(empty($input_mobile))
	 {
	 	$mobile_err = "Please Enter Mobile Number";
	 }else{
	 	$mobile = $input_mobile;
	 }
	  if(empty($input_fee))
	 {
	 	$fee_err = "Please Enter fee";
	 }else{
	 	$fee = $input_fee;
	 }
	 if(empty($input_gender))
	 {
	 	$gender_err = "Please Enter Gender";
	 }else{
	 	$gender = $input_gender;
	 }
	 if(empty($input_email))
	{
	 	$email_err = "Please Enter Email";
	}else
	{
	$query = "select doctor_email from doctor where doctor_email = '{$input_email}'";
    $result1 = mysqli_query($mysqli,$query) or die("Email query wrong");
    if(mysqli_num_rows($result1) == 1)
    {
    	$email_err = "Already Use Email";
    }else{
	 	$email =$input_email;
	}
    }
	 if(empty($input_specialist))
	 {
	 	$Specialist_err = "Please Enter Specialist";
	 }else{
	 	$Specialist = $input_specialist;
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
    if(empty($name_err) && empty($address_err) && empty($email_err) && empty($mobile_err) && empty($Specialist_err) && empty($gender_err) && empty($password_err) && empty($fee_err))
    {
        $q = "Insert into doctor (doctor_name,doctor_specialist,doctor_cost,doctor_mobile,doctor_gender,doctor_email,doctor_password,doctor_address) values ('{$name}','{$Specialist}','{$fee}','{$mobile}','{$gender}','{$email}','{$password}','{$address}')";
    	mysqli_query($mysqli,$q) or die('Wrong Inser Query');
    	header("Location: http://localhost/HMS/ADashboard/ManageDoctor.php");
    }
    mysqli_close($mysqli);
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Doctor</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">
	body
	{
		background-image: url('DoctorSignup.jpg');
		position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
	.radio{
		width: 10px;
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
<div style="margin-top: 10px; margin-left: 700px; background: url('doctorformbg.png'); width: 400px; height: 870px;
  opacity: 0.7; border-radius: 50px;">
	<h3 style="background-color: #87CEEB; padding-left: 100px; padding-top: 30px;padding-bottom: 30px; border-radius: 50px;">Add Doctor</h3>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="padding-left: 50px">
		<label>Full Name:</label><br>
		<input type="text" name="name"><br><?php echo $name_err ?><br>
		<label>Specialist:</label><br>
		<?php
		require_once 'config.php';
		$sql = "select * from Specialist";
		$result = mysqli_query($mysqli,$sql) or die("Select Query Wrong");
		if(mysqli_num_rows($result)>0)
		{
		 ?>
		<select name = "Specialist">
			<?php
			 while ($row = mysqli_fetch_assoc($result)) {
			?>
			<option value="<?php echo $row['specialist_name']; ?> " ><?php echo $row['specialist_name'] ?></option>
			<?php }
			?>
		</select><br><?php echo $Specialist_err ?><br>
	<?php }else{
		echo "No Specialist Found";
	} 
	mysqli_close($mysqli); 
	?>
		<label>Cost:</label><br>
		<input type="number" name="fee"><br><?php echo $fee_err ?><br>
		<label>Gender:</label><br>
        <label><input type="radio" name="gender" value="M" class="radio">
        Male</label>
        <label><input type="radio" name="gender" value="F" class="radio">
        Female</label><br><?php echo $gender_err ?><br>
		<label>Mobile:</label><br>
		<input type="tel" name="mobile" pattern="[0-9]{4}-[0-9]{7}" placeholder="xxxx-xxxxxxx"><br><?php echo $mobile_err ?><br>
		<label>Email:</label><br>
		<input type="email" name="email"><br><?php echo $email_err ?><br>
		<label>Password:</label><br>
		<input type="Password" name="password"><br><br>
		<label>Confirm Password:</label><br>
		<input type="Password" name="conpassword"><br>
		<?php echo $password_err ?><br><br>
		<label>Address:</label><br>
		<textarea rows="2",cols="40" style="margin-left: 0px" name="address"></textarea><br><?php echo $address_err ?><br>
		 <button type="submit" value="Submit" name="signup">Add</button>
	</form>
</div>
</div>
</body>
</html>