<?php

include_once("connections/connection.php");
$con = connection();

if (isset($_POST['deleteCustomer'])) {

   $id = $_POST['ID'];
   $sql = "DELETE FROM `customer_details` WHERE id = '$id'";
   $con->query($sql) or die($con->error);
   echo header("Location: dashboard.php");
}
