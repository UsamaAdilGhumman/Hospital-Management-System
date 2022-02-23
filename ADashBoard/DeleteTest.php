<?php
require_once 'config.php';
$id = $_GET['id'];
$sql = "Delete from test where test_id = '{$id}'";
mysqli_query($mysqli,$sql) or die('Wrong Delete Qurey');
mysqli_close($mysqli);
header("Location: http://localhost/HMS/ADashboard/ManageTest.php");
?>