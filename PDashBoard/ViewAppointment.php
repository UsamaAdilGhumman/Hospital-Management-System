<!DOCTYPE html>
<html>
<head>
	<title>View Appointment</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">
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
        <a class="navbar-brand" href="Logout.php" >Log Out</a>
      </div>
  </div>
</nav>
<h2 align="center">View Appointment</h2>
<div class="container">
  <div class="row">
    <div class="col-12">
   <?php
      require_once '../ADashboard/config.php';
        session_start();
        $id = $_SESSION['id'];
      $sql = "Select * from appointment_view where patient_id = '{$id}'";
      $result =mysqli_query($mysqli,$sql) or die("Wrong Select Query");
      if(mysqli_num_rows($result)>0)
      {
       ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Doctor Name</th>
            <th>Description</th>
            <th>Date</th>
            <th>Solution</th>
            <th>Test</th>
            <th>Fee</th>
          </tr>
        </thead>
        <tbody>
         <?php 
          while($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
            <td><?php echo $row['doctor_name'] ?></td>
            <td><?php echo $row['appointment_description'] ?></td>
            <td><?php echo $row['appointment_date'] ?></td>
            <td><?php echo $row['solution'] ?></td>
            <td><?php echo $row['test'] ?></td>
            <td><?php echo $row['fee'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
      </table>
           <?php }else{
          echo "No Record found";
        }
        mysqli_close($mysqli)
        ?>
    </div>
  </div>
</div>
</body>
</html>