<!DOCTYPE html>
<html>
<head>
	<title>Manage Doctor</title>
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
        <a class="navbar-brand" href="logout.php" >Log Out</a>
      </div>
  </div>
</nav>
<h2 align="center">Manage Doctor</h2>
<a href="AddDoctor.php"><button type="Submit" value="Add" class="btn btn-primary" style="margin-left: 1100px;">Add Doctor</button></a>
<div class="container">
  <div class="row">
    <div class="col-12">
      <?php
      require_once 'config.php';
      $sql = "Select * from Doctor";
      $result =mysqli_query($mysqli,$sql) or die("Wrong Select Query");
      if(mysqli_num_rows($result)>0)
      {
       ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>Specialist</th>
            <th>fee</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Address</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          while($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
            <td><?php echo $row['doctor_name']; ?></td>
            <td><?php echo $row['doctor_gender']; ?></td>
            <td><?php echo $row['doctor_specialist']; ?></td>
            <td><?php echo $row['doctor_cost']; ?></td>
            <td><?php echo $row['doctor_mobile']; ?></td>
            <td><?php echo $row['doctor_email']; ?></td>
            <td><?php echo $row['doctor_address']; ?></td>
            <td>
          <a href="DoctorEdit.php?id=<?php echo $row['doctor_id']; ?>"><button type="button" class="btn btn-success">Edit</button></a>
          <a href="DeleteDoctor.php?id=<?php echo $row['doctor_id']; ?>"><button type="button" class="btn btn-danger" name="delete">Delete</button></a>
            </td>
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