<?php

include_once("connections/connection.php");
$con = connection();

if (isset($_POST['deleteCustomer'])) {

   $id = $_POST['id'];
   $sql = "DELETE FROM `customer_details` WHERE id = '$id'";
   $con->query($sql) or die($con->error);
   echo header("Location: dashboard.php");
}
// SELECT employees.id FROM employees WHERE employees.full_name = '$employee',
//    SELECT technicians.id FROM technicians WHERE technicians.full_name = '$technician',
//    `received_by_id`, `technician_id`, 