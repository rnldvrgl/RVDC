<?php

include_once("connections/connection.php");
$con = connection();

if (isset($_POST['submit'])) {

   $fname = $_POST['firstname'];
   $lname = $_POST['lastname'];
   $address = $_POST['address'];
   $cnumber = $_POST['contact_number'];
   $sql = "INSERT INTO `customer_details`(`first_name`, `last_name`, `address`, `contact_number`) VALUES ('$fname','$lname','$address','$cnumber')";
   $con->query($sql) or die($con->error);

   echo header("Location: add.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>RVDC Ref and Aircon Repair Shop</title>
   <link rel="stylesheet" href="css/style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
   <div class="container h-100">
      <div class="justify-content-center form_container">
         <div class="row">
            <div class="col-lg-7 mx-auto">
               <div class="bg-white rounded-lg shadow-sm p-5">
                  <div id="nav-tab-card" class="tab-pane fade show active">
                     <!-- <p class="alert alert-success">Some text success or error</p> -->
                     <form action="add.php" method="post">

                        <div class="form-group mb-2">
                           <label for="firstname">First Name</label>
                           <input type="text" name="firstname" placeholder="Enter First Name ..." required class="form-control">
                        </div>

                        <div class="form-group mb-2">
                           <label for="lastname">Last Name</label>
                           <input type="text" name="lastname" placeholder="Enter Last Name ..." required class="form-control">
                        </div>

                        <div class="form-group mb-2">
                           <label for="address">Address</label>
                           <textarea class="form-control" name="address" rows="2"></textarea>
                        </div>

                        <div class="form-group mb-3">
                           <label for="contact_number">Contact Number</label>
                           <input type="text" name="contact_number" pattern="^(09|\+639)\d{9}$" placeholder="Enter Contact Number ..." required class="form-control">
                        </div>

                        <div class="form-group">
                           <a type="button" class="btn btn-danger btn-block shadow-sm" href="dashboard.php">Cancel</a>
                           <input type="submit" name="submit" value="Add Customer" class="btn btn-success shadow-sm"></input>
                        </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>