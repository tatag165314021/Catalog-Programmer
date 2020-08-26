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
            <a href="index.html">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Ganti Password</li>
        </ol>

        <!-- Page Content -->
        <h1>Ganti Password</h1>
        <hr>
        <div class="col-md-4 col-md-offset-4" id="login">
                <div id="inner-wrapper" class="login">
                    <article>
                        <form action="update_password.php" method="POST">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['id_login']; ?>">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"> </i></span>
                                        <input type="password" name="password_lama" id="password_baru" onkeyup="check();" class="form-control" placeholder="Password Lama">
                                        <!--<span id = "password_validation" class="error"></span>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"> </i></span>
                                        <input type="password" name="password_baru" id="password" onkeyup="check();" class="form-control" placeholder="Password Baru"><br/>
                                        <span id = "konfirm_password_validation" class="error"></span>
                                        <!--<span id = 'message_confirm'></span>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"> </i></span>
                                        <input type="password" name="konfirm_password_baru" id="konfirm_password" onkeyup="check();" class="form-control" placeholder="Konfirmasi Password Baru"><br/>
                                        <span id = "konfirm_password_validation" class="error"></span><br/>
                                        
                                    </div>
                                    <div class="input-group">
                                        <span id = 'message_confirm'></span>
                                    </div>
                                    
                                </div>

                            <button type="submit" class="btn btn-success btn-block" name="ganti_password"><b>Ubah Password</b></button>
                        </form>
                    </article>
                </div>
            </div>

      </div>
      <!-- /.container-fluid -->

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

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>
  
  <script>
                /*==================================================================
                 [ Mengecek password dan konfirmasi password Saat mendaftar ]*/
                var check = function () {
                    if (document.getElementById('password').value === document.getElementById('konfirm_password').value) {
                        document.getElementById('message_confirm').style.color = 'green';
                        document.getElementById('message_confirm').style.display = "block";
                        document.getElementById('message_confirm').innerHTML = '';
                    } else {
                        document.getElementById('message_confirm').style.color = 'red';
                        document.getElementById('message_confirm').style.display = "block";
                        document.getElementById('message_confirm').innerHTML = 'Tidak Cocok Dengan Password Yang Dibuat';
                    }
                };

   </script>
</body>

</html>
<?php
}
?>