<?php

//session starts
if (!isset($_SESSION)) {
   session_start();
}

if (isset($_SESSION['Access']) && $_SESSION['Access'] == "admin") {
} else {
   echo header("Location: dashboard.php");
}

include_once("connections/connection.php");
$con = connection();

$id = $_GET['ID'];

$sql = "SELECT * FROM customer_details WHERE id ='$id'";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>RVDC Ref and Aircon Repair Shop | Details</title>
   <link rel="stylesheet" href="css/style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
   <div class="container-fluid">
      <h1>Customer Details</h1>

      <form action="deleteCustomer.php" method="post">
         <a type="button" class="btn btn-warning mb-2" href="editCustomer.php?ID=<?php echo $row['id']; ?>">Edit Details</a>
         <button type="submit" class="btn btn-danger mb-2" href="deleteCustomer.php" name="deleteCustomer">Delete</button>
         <input type="hidden" name="ID" id="" value="<?php echo $row['id']; ?>">
         <a type="button" class="btn btn-dark mb-2" href="logout.php">Logout</a>
      </form>

      <table class="table table-bordered">
         <thead>
            <tr>
               <th>First Name</th>
               <th>Last Name</th>
               <th>Address</th>
               <th>Contact Number</th>
            </tr>
         </thead>
         <tbody>
            <?php do { ?>
               <tr>
                  <td><?php echo $row['first_name'] ?></td>
                  <td><?php echo $row['last_name'] ?></td>
                  <td><?php echo $row['address'] ?></td>
                  <td><?php echo $row['contact_number'] ?></td>
               </tr>
            <?php } while ($row = $students->fetch_assoc()); ?>
         </tbody>
      </table>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>