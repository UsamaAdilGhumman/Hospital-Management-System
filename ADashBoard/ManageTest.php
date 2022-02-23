<?php
require_once 'config.php';
$test_err=$test='';
if(isset($_POST['Add']))
{
  $input_test = trim($_POST['test']);
  if(empty($input_test))
  {
    $test_err = 'Plesae Enter Test Name';
  }else
  {
    $test = $input_test;
    $sql = "Insert into test (test_name) values ('{$test}')";
    mysqli_query($mysqli,$sql) or die("Wrong Insert Query");
    header("Location: http://localhost/HMS/ADashboard/ManageTest.php");
  }

  mysqli_close($mysqli);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Test</title>
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
<h2 align="center">Manage Test</h2>
<form style="margin-left: 570px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<input type="text" name="test" value="<?php $test ?>">
<input type="Submit" name="Add" value="Add" class="btn btn-primary"><br>
<?php echo $test_err ?>
</form>
<div class="container">
  <div class="row">
    <div class="col-12">
<?php
if(empty($test_err))
{
require_once 'config.php';
$sql1 = "Select * from test";
$result = mysqli_query($mysqli,$sql1) or die('Wrong Select Query');
if(mysqli_num_rows($result)>0)
{
 ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Test Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)){
           ?>
          <tr>
            <td><?php echo $row['test_name'] ?></td>
            <td><a href="DeleteTest.php?id=<?php echo $row['test_id'] ?>"><button class="btn btn-danger">Delete</button></a></td>
          </tr>
        <?php 
      }
        ?>
        </tbody>
      </table>
<?php }else{
  echo "No Record Found";
}

mysqli_close($mysqli); }
?>
    </div>
  </div>
</div>
</body>
</html>