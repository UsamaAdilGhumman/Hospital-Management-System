<?php
require_once 'config.php';
$id = $_GET['id'];
$sql = "Delete from Doctor where doctor_id = '{$id}'";
mysqli_query($mysqli,$sql) or die('Wrong Delete Qurey');
mysqli_close($mysqli);
header("Location: http://localhost/HMS/ADashboard/ManageDoctor.php");
?>