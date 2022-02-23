<?php
require_once 'config.php';
$id = $_GET['id'];
$sql = "Delete from Appointment where appointment_id = '{$id}'";
mysqli_query($mysqli,$sql) or die('Wrong Delete Qurey');
mysqli_close($mysqli);
header("Location: http://localhost/HMS/ADashboard/ManageAppointment.php");
?>