<?php
require_once 'config.php';
$Specialist_err = $Specialist = '';
if(isset($_POST['Add']))
{
  $input_Specialist = trim($_POST['Specialist']);
  if(empty($input_Specialist))
  {
    $Specialist_err = 'Please Enter Specialist';
}else if(!filter_var($input_Specialist, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
  $Specialist_err = 'Please enter a valid Specialist';
}else{
  $Specialist = $input_Specialist;
  $query = "Insert into Specialist (specialist_name) values('{$Specialist}')";
  mysqli_query($mysqli,$query) or die("wrong insert query");
  header("Location: http://localhost/HMS/ADashboard/ManageSpecialist.php");
}
mysqli_close($mysqli);
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Specialist</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">
input{
  width: 200px;
  height: 33px;
}
.container {
  padding: 2rem 0rem;
}

h4 {
  margin: 2rem 0rem 1rem;
}

.table-image {
  td, th {
    vertical-align: middle;
  }
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
<h2 align="center">Manage Specialist</h2>
<form style="margin-left: 570px;" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
<input type="text" name="Specialist" value="<?php $Specialist ?>">
<input type="Submit" value="Add" name="Add" class="btn btn-primary"><br>
<?php echo $Specialist_err ?>
</form>
<div class="container">
  <div class="row">
    <div class="col-12">
      <?php
if(empty($Specialist_err))
{
  require_once 'config.php';
  $sql = 'Select * from Specialist';
  $result = mysqli_query($mysqli,$sql) or die("Wrong Select Query");
  if(mysqli_num_rows($result)>0)
  {
?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Specialist Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {?>
          <tr>
            <td><?php echo $row['specialist_name'] ?></td>
            <td><a href="DeleteSpecialist.php?id=<?php echo $row['specialist_id'] ?>"><button class="btn btn-danger">Delete</button></a></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <?php
} else{
  echo "No Record Found";
}
mysqli_close($mysqli);
 }?>
    </div>
  </div>
</div>
</body>
</html>