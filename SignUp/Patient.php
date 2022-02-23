<?php
require_once 'config.php';
$name=$mobile=$email=$gender=$address=$password=$bloodGroup = "";
$name_err=$bloodGroup_err=$mobile_err=$email_err=$gender_err=$address_err=$password_err="";
if(isset($_POST['signup']))
{
	 $input_bloodGroup = $_POST['bloodGroup'];
	 $input_name = trim($_POST['name']);
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
    $bloodGroup = $input_bloodGroup;
    if(empty($name_err) && empty($address_err) && empty($email_err) && empty($mobile_err) && empty($gender_err) && empty($password_err))
    {
    	$q = "Insert into patient (patient_name,patient_mobile,patient_gender,patient_email,patient_password,patient_address,patient_blood_group) values ('{$name}','{$mobile}','{$gender}','{$email}','{$password}','{$address}','{$bloodGroup}')";
    	 mysqli_query($mysqli,$q) or die('Wrong Insert Query');
    	header("Location: http://localhost/HMS/LoginPage/PatientLogin.php");
    }
    mysqli_close($mysqli);
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Patient Sign Up</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">
	body
	{
		background-image: url('PatientSignup.jpg');
		background-repeat: no-repeat;
		background-size: cover;
		opacity: 0.8;
	}
	input,select{
		border-radius: 50px;
		width: 300px;
	}
	option,button{
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
<div style="margin-left: 40px; background-color: #C0C0C0; width: 400px; border-radius: 50px; height: 800px;">
	<h3 style="padding: 20px; margin-left: 70px;">Patient Sign Up</h3>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="padding-left: 30px;">
		<label>Full Name:</label><br>
		<input type="text" name="name"><br><?php echo $name_err ?><br>
		<label>Gender:</label><br>
        <label><input type="radio" name="gender" value="M" class="radio">
        Male</label>
        <label><input type="radio" name="gender" value="F" class="radio">
        Female</label><br><?php echo $gender_err ?><br>
		<label>Mobile:</label><br>
		<input type="phone" name="mobile" pattern="[0-9]{4}-[0-9]{7}" placeholder="xxxx-xxxxxxx"><br><?php echo $mobile_err ?><br>
		<label>Email:</label><br>
		<input type="Email" name="email"><br><?php echo $email_err ?><br>
		<label>Password:</label><br>
		<input type="password" name="password"><br><br>
		<label>Confirm Password:</label><br>
		<input type="password" name="conpassword"><br><?php echo $password_err ?><br>
		<label>Address:</label><br>
		<textarea rows="2",cols="40" style="margin-left: 0px" name="address"></textarea><br><?php echo $address_err ?><br>
		<label for="bloodGroup">Blood Group:</label><br>
        <select name="bloodGroup">
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
        <option value="O-">O-</option>
        <option value="O+">O+</option>
         </select><br><?php echo $bloodGroup_err ?><br>
         <button type="submit" value="signup" name="signup">Sign Up</button>
         <button type="reset" value="Reset">Reset</button><br><br>
         <label>Already Have An Account. <a href="../LoginPage/PatientLogin.php">Login In</a></label>
	</form>
</div>
</body>
</html>