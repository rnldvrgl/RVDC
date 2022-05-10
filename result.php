<?php

//session starts
if (!isset($_SESSION)) {
   session_start();
}

include_once("connections/connection.php");
$con = connection();
$search = $_GET['search'];
$sql = "SELECT * FROM customer_details WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR contact_number LIKE '%$search%'";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Student Management System</title>
   <link rel="stylesheet" href="css/style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
   <div class="container-fluid">
      <?php
      if (isset($_SESSION['UserLogin'])) {
         echo "WELCOME " . strtoupper($_SESSION['UserLogin']);
      } else {
         echo "WELCOME GUEST!";
      }
      ?>
      <h1>Customers Information System</h1>
      <a type="button" class="btn btn-success mb-2" href="addCustomer.php">Add New</a>
      <a type="button" class="btn btn-dark mb-2" href="logout.php">Logout</a>
      <form action="result.php" method="get">
         <input type="text" name="search" id="search">
         <button type="submit">Search</button>
      </form>
      <div class="table-responsive-sm">
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Contact Number</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php do { ?>
                  <tr>
                     <td><?php echo $row['first_name'] ?></td>
                     <td><?php echo $row['last_name'] ?></td>
                     <td><?php echo $row['contact_number'] ?></td>
                     <td class="text-center">
                        <a type="button" class="btn btn-block btn-info" href="customerDetails.php?id=<?php echo $row['id']; ?>">View Details</a>
                        <!-- <a type="button" class="btn btn-block btn-info" href="customerDetails.php?id=<?php echo $row['id']; ?>">View Walk Service</a> -->
                        <!-- <a type="button" class="btn btn-block btn-info" href="customerDetails.php?id=<?php echo $row['id']; ?>">View Home Service</a> -->
                     </td>
                  </tr>
               <?php } while ($row = $students->fetch_assoc()); ?>
            </tbody>
         </table>
      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>