<!DOCTYPE html>
<html>
<head>
	<title>Manage Patient</title>
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
<h2 align="center">Manage Patient</h2>
<a href="AddPatient.php"><button type="Submit" value="Add" class="btn btn-primary" style="margin-left: 1100px;">Add Patient</button></a>
<div class="container">
  <div class="row">
    <div class="col-12">
      <?php
      require_once 'config.php';
      $sql = "Select * from Patient";
      $result =mysqli_query($mysqli,$sql) or die("Wrong Select Query");
      if(mysqli_num_rows($result)>0)
      {
       ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Address</th>
            <th>Blood Group</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          while($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
            <td><?php echo $row['patient_name']; ?></td>
            <td><?php echo $row['patient_gender']; ?></td>
            <td><?php echo $row['patient_mobile']; ?></td>
            <td><?php echo $row['patient_email']; ?></td>
            <td><?php echo $row['patient_address']; ?></td>
            <td><?php echo $row['patient_blood_group']; ?></td>
            <td>
            <a href="PatientEdit.php?id=<?php echo $row['patient_id']; ?>"><button type="button" class="btn btn-success">Edit</button></a>
             <a href="DeletePatient.php?id=<?php echo $row['patient_id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
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