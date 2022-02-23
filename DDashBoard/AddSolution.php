<?php 
$solution_err = "";
if(isset($_POST['sol']))
{
	$id = $_POST['a_id'];
    $solution = $_POST['solution'];
    if(empty($solution))
    {
    	$solution_err = 'Please Enter Solution';
    }
    else
    {
    	require_once '../LoginPage/config.php';
	    $sql = "Update Appointment set solution = '{$solution}' where appointment_id = '{$id}'";
	    mysqli_query($mysqli,$sql) or die("Wrong Update Query");
	    mysqli_close($mysqli);
	    header("location: http://localhost/HMS/DDashboard/ViewAppointment.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Solution</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">
	body{
		background: url('../LoginPage/DoctorLogin.jpg');
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>
</head>
<body>
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
<div style="border: solid silver 2px; background-color: silver; margin-left: 50px; padding: 20px; width: 280px; border-radius: 50px;">

	<h2 style="margin-left: 30px;">Add Solution</h2>
<form style="margin-left: 30px;" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
	<label>Description: </label><br>
	<?php 
	$id = $_GET['id'];
	require_once "../LoginPage/config.php";
	$q1 = "Select * from Appointment where appointment_id = {$id}";
	$result2 = mysqli_query($mysqli,$q1) or die("Wrong Query");
	while($row2 = mysqli_fetch_assoc($result2)){
	?>
	<input type="hidden" name="a_id" value="<?php echo $row2['appointment_id']; ?>">
	<label><?php echo $row2['appointment_description'];?></label><br>
	 <?php } ?>
	<label>Solution:</label><br>
	<textarea rows="3",cols="40" name="solution" ></textarea><br><br>
	<input type="submit" class="btn btn-primary" name="sol" value="Solution">
</form>
</div>
</body>
</html>