<?php

//session starts
if (!isset($_SESSION)) {
   session_start();
}

//database connection
include_once("connections/connection.php");
$con = connection();

if (isset($_POST['login'])) {

   $username = $_POST['username'];
   $password = $_POST['password'];

   $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

   $user = $con->query($sql) or die($con->error);
   $row = $user->fetch_assoc();
   $total = $user->num_rows;

   if ($total > 0) {
      $_SESSION['UserLogin'] = $row['username'];
      $_SESSION['Access'] = $row['access'];
      echo header("Location: dashboard.php");
   } else {
      echo "No users found!";
   }
}

if (isset($_SESSION['UserLogin'])) {
   echo header("Location: dashboard.php");
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
   <!-- Theme style -->
   <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
   <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
         <div class="card-header text-center">
            <h1><b>RVDC</b> Management System</a></h1>
         </div>
         <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="" method="post">
               <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                     </div>
                  </div>
               </div>
               <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <!-- /.col -->
                  <div class="col-12">
                     <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
                  </div>
                  <!-- /.col -->
               </div>
            </form>
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
   </div>
   <!-- /.login-box -->

   <!-- jQuery -->
   <script src="plugins/jquery/jquery.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- AdminLTE App -->
   <script src="dist/js/adminlte.min.js"></script>
</body>

</html>