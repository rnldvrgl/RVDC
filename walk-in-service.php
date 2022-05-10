<?php

//session starts
if (!isset($_SESSION)) {
   session_start();
}

// if (isset($_SESSION['Access']) && $_SESSION['Access'] == "admin") {
// } else {
//    echo header("Location: dashboard.php");
// }

include_once("connections/connection.php");
$con = connection();

$id = $_GET['id'];

$sql = "SELECT
walk_in_service.appliances_type AS appliances_type, 
walk_in_service.job_type AS job_type,
walk_in_service.date_received AS received_date, 
walk_in_service.date_claimed  AS claimed_date, 
walk_in_service.payment_date  AS payment_date, 
walk_in_service.payment_amount AS payment_amount, 
technicians.full_name AS technician_name,
employees.full_name AS employees
FROM walk_in_service 
INNER JOIN technicians ON walk_in_service.technician_id=technicians.technician_id 
INNER JOIN employees ON employees.employee_id=walk_in_service.employee_id
WHERE walk_in_service.customer_id ='$id'";
$WI_service = $con->query($sql) or die($con->error);
$row = $WI_service->fetch_assoc();
$num_rows = mysqli_num_rows($WI_service);

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
                     <h1>Walk-In Services</h1>
                  </div>
                  <div class="col-sm-6 d-grid d-md-flex justify-content-md-end">
                     <a type="button" class="btn btn-success" href="add-walk-in-service.php?id=<?php echo $id ?>">
                        <i class="fas fa-user-plus"></i>
                        Add New Walk-In Service
                     </a>
                  </div>
               </div>
            </div><!-- /.container-fluid -->
         </section>

         <!-- Main content -->
         <section class="content">
            <div class="container-fluid">
               <div class="col-lg-6 col-12">
                  <!-- small card -->
                  <div class="small-box bg-secondary info-box shadow">
                     <div class="inner">
                        <h3><?php echo $num_rows; ?></h3>
                        <p>Total Walk-In Service of Customer</p>
                     </div>
                     <div class="icon">
                        <i class="fas fa-user"></i>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <div class="card">
                        <div class="card-body">
                           <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th>Added By</th>
                                    <th>Technician</th>
                                    <th>Appliances Type</th>
                                    <th>Job Type</th>
                                    <th>Received Date</th>
                                    <th>Claimed Date</th>
                                    <th>Date of Payment</th>
                                    <th>Payment Amount</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php do { ?>
                                    <tr>
                                       <td><?php echo $row['employees']; ?></td>
                                       <td><?php echo $row['technician_name'] ?></td>
                                       <td><?php echo $row['appliances_type'] ?></td>
                                       <td><?php echo $row['job_type'] ?></td>
                                       <td><?php echo $row['received_date'] ?></td>
                                       <td><?php echo $row['claimed_date'] ?></td>
                                       <td><?php echo $row['payment_date'] ?></td>
                                       <td><?php echo $row['payment_amount'] ?></td>
                                       <td>
                                          <?php if ($num_rows > 0) {  ?>
                                             <div class="d-flex justify-content-center">
                                                <a type="button" class="btn btn-success btn-sm" href="edit-walk-in-service.php?id=<?php echo $row['id']; ?>">
                                                   <i class="fas fa-edit"></i>
                                                   Update Walk-In Service
                                                </a>
                                             </div>
                                          <?php } ?>
                                       </td>
                                    </tr>
                                 <?php } while ($row = $WI_service->fetch_assoc()); ?>
                              </tbody>
                           </table>
                        </div>
                        <!-- /.card-body -->
                     </div>
                     <!-- /.card -->
                  </div>
                  <!-- /.col -->
               </div>
               <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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

   <!-- Page specific script -->
   <script>
      $(function() {
         $("#example1").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            scrollY: 400,
         }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      });
   </script>
</body>

</html>