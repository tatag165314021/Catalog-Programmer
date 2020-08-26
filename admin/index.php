<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['id_login']) == 0) {
    header('location:login.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ADMIN | ORCOIS</title>
  <link rel="shortcut icon" href="img/orcois_logo.png">
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <?php include('includes/navbar.php'); ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('includes/sidebar.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
<!--          <li class="breadcrumb-item active">Overview</li>-->
        </ol>
        
        

      </div>
      <!-- /.container-fluid -->
      <div class="card mb-3">
          <div class="card-body"><h1>SELAMAT DATANG ADMIN CODER</h1></div>
      </div>
      <!-- Sticky Footer -->
      <?php include('includes/footer.php');?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
<!--  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>-->

  <!-- Custom scripts for all pages-->
  <!--<script src="js/sb-admin.min.js"></script>-->

  <!-- Demo scripts for this page-->
<!--  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>-->

</body>

</html>
<?php
}
?>