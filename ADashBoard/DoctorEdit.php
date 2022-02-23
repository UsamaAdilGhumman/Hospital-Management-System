<?php 
  if(isset($_POST['update']))
  {
  	require_once 'config.php';
  	$mobile = $_POST['Phone'];
   $fee = $_POST['fee'];
   $email = $_POST['email'];
   $address = $_POST['Address'];
   $name = $_POST['name'];
   $id = $_POST['id'];
   $Specialist = $_POST['Specialist'];
 $q = "Update doctor set doctor_name = '{$name}',doctor_specialist = '{$Specialist}', doctor_cost = '{$fee}',
 doctor_mobile = '{$mobile}', doctor_email = '{$email}', doctor_address = '{$address}' where doctor_id = '{$id}'";
    	mysqli_query($mysqli,$q) or die('Wrong Update Query');
    	header("Location: http://localhost/HMS/ADashboard/ManageDoctor.php");
    mysqli_close($mysqli);
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
		background-image: url('DashBoard.jpg');
		position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
	input,select{
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
<div style="background-color: silver; width: 370px; height: 550px; padding-left: 20px; padding-top: 2px;">
	<h2>Edit Doctor Information</h2>
	<?php 
	require_once 'config.php';
	$id = $_GET['id'];
	$sql = "Select * from doctor where doctor_id = '{$id}'";
	$result = mysqli_query($mysqli,$sql) or die('Wrong Select Query');
	if(mysqli_num_rows($result)>0)
	{
		while ($row = mysqli_fetch_assoc($result)) {
	?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<input type="hidden" name="id" value="<?php echo $row['doctor_id']?>">
	    <label>First Name:</label><br>
		<input type="text" name="name" value="<?php echo $row['doctor_name'] ?>"><br><br>
		<label>Specialist:</label><br>
		<?php
		require_once 'config.php';
		$q = "Select * from Specialist";
		$result1 = mysqli_query($mysqli,$q) or die('Wrong Select Query');
		if(mysqli_num_rows($result1)>0) {
		 ?>
		<select name="Specialist">
			<?php while($row1 = mysqli_fetch_assoc($result1)) {?>
			<option value="<?php echo $row1['specialist_name'] ?>"><?php echo $row1['specialist_name'] ?></option>
		<?php } ?>
		</select><br><br> <?php } ?>

		<label>Fee:</label><br>
		<input type="number" name="fee" value="<?php echo $row['doctor_cost'] ?>"><br><br>
		<label>Mobile:</label><br>
		<input type="Phone" name="Phone" value="<?php echo $row['doctor_mobile'] ?>"><br><br>
		<label>Email:</label><br>
		<input type="email" name="email" value="<?php echo $row['doctor_email'] ?>"><br><br>
		<label>Address:</label><br>
		<textarea rows="2",cols="40" style="margin-left: 0px" name="Address"><?php echo $row['doctor_address'] ?></textarea><br><br>
		 <button type="submit" value="Update" name="update">Update</button>
	</form>
   <?php } } ?>
</div>
</body>
</html>