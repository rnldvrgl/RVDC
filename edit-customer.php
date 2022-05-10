<?php

include_once("connections/connection.php");
$con = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM customer_details WHERE id ='$id'";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

if (isset($_POST['submit'])) {

   $fname = $_POST['firstname'];
   $lname = $_POST['lastname'];
   $address = $_POST['address'];
   $cnumber = $_POST['contact_number'];
   $sql = "UPDATE `customer_details` SET `first_name` = '$fname', `last_name` = '$lname', `address` = '$address', `contact_number` = '$cnumber' WHERE id = '$id'";
   $con->query($sql) or die($con->error);

   echo header("Location: customer-details.php?id=" . $id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>RVDC Management System</title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
   <!-- icheck bootstrap -->
   <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
   <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
         <!-- Left navbar links -->
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
         </ul>

         <!-- Right navbar links -->
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="logout.php" role="button">
                  <i class="fas fa-sign-out-alt"></i>
               </a>
            </li>
         </ul>
      </nav>

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
         <!-- Brand Logo -->
         <a href="dashboard.php" class="brand-link">
            <img src="dist/img/rvdc_logo.jpg" alt="RVDC Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">RVDC Repair Shop</span>
         </a>

         <!-- Sidebar -->
         <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                     <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Dashboard
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="walk-in-service-dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-walking"></i>
                        <p>
                           Walk-In Services
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="home-service-dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                           Home Services
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="calendar.php" class="nav-link">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>
                           Calendar
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="calendar.php" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                           Inventory
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="calendar.php" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                           Reports
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="employees.php" class="nav-link">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                           Employees
                        </p>
                     </a>
                  </li>
               </ul>
            </nav>
            <!-- /.sidebar-menu -->
         </div>
         <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1>Edit Customer</h1>
                  </div>
               </div>
            </div>
            <!-- /.container-fluid -->
         </section>

         <!-- Main content -->
         <section class="content">
            <div class="row">
               <div class="col-md-6 m-auto">
                  <div class="card card-primary">
                     <div class="card-header">
                        <h3 class="card-title">Customer Information</h3>
                     </div>
                     <div class="card-body">
                        <form action="" method="post">
                           <div class="form-group mb-2">
                              <label for="firstname">First Name</label>
                              <input type="text" name="firstname" placeholder="Enter First Name ..." required class="form-control" value="<?php echo $row['first_name']; ?>">
                           </div>

                           <div class="form-group mb-2">
                              <label for="lastname">Last Name</label>
                              <input type="text" name="lastname" placeholder="Enter Last Name ..." required class="form-control" value="<?php echo $row['last_name']; ?>">
                           </div>

                           <div class="form-group mb-2">
                              <label for="address">Address</label>
                              <textarea class="form-control" name="address" rows="2"><?php echo $row['address']; ?></textarea>
                           </div>

                           <div class="form-group mb-3">
                              <label for="contact_number">Contact Number</label>
                              <input type="text" name="contact_number" pattern="^(09|\+639)\d{9}$" placeholder="Enter Contact Number ..." required class="form-control" value="<?php echo $row['contact_number']; ?>">
                           </div>
                           <div class="row d-flex justify-content-end">
                              <button onclick="history.go(-1);" class="btn btn-secondary">Cancel</button>
                              <input type="submit" name="submit" value="Update Info" class="btn btn-success float-right">
                           </div>
                        </form>
                     </div>
                     <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
               </div>
            </div>
         </section>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->


      <footer class="main-footer">
         <div class="float-right d-none d-sm-block">
            <b>RVDC</b> Ref and Aircon Repair Shop
         </div>
         <strong>Copyright &copy; 2022 </strong>
      </footer>

   </div>
   <!-- ./wrapper -->
   <!-- jQuery -->
   <script src="plugins/jquery/jquery.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- DataTables  & Plugins -->
   <script src="plugins/datatables/jquery.dataTables.min.js"></script>
   <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
   <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
   <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
   <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
   <script src="plugins/jszip/jszip.min.js"></script>
   <script src="plugins/pdfmake/pdfmake.min.js"></script>
   <script src="plugins/pdfmake/vfs_fonts.js"></script>
   <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
   <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
   <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
   <!-- AdminLTE App -->
   <script src="dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="dist/js/demo.js"></script>
</body>

</html>