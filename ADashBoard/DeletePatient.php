<?php
require_once 'config.php';
$id = $_GET['id'];
$sql = "Delete from Patient where patient_id = '{$id}'";
mysqli_query($mysqli,$sql) or die('Wrong Delete Qurey');
mysqli_close($mysqli);
header("Location: http://localhost/HMS/ADashboard/ManagePatient.php");
?>