<?php
session_start();
include('includes/config.php');

function encrypted($kode) {
    // Store the cipher method 
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method 
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption 
    $encryption_iv = '1234567891011121';

    // Store the encryption key 
    $encryption_key = "orcoiste";

    // Use openssl_encrypt() function to encrypt the data 
    $encryption = openssl_encrypt($kode, $ciphering, $encryption_key, $options, $encryption_iv);
    return $encryption;
}

if (isset($_POST['login'])) {
    $username = addslashes(trim(@$_POST['username']));
    $password = @$_POST['password'];
//    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    if (empty($username)) {
        array_push($errors, "Username required");
    }
    if (empty($password)) {
        array_push($errors, "Password required");
    }
    if (empty($errors)) {
        // ambil data dari database
        $pass = encrypted($password);
        $query = mysqli_query($con,"SELECT * FROM admin WHERE username='$username'");
        $admin = mysqli_fetch_assoc($query);
        
// bandingkan password yang dikirim dari form login dengan password
// yang ada di database
        if (mysqli_num_rows($query)>0) {
            // login berhasil
            $_SESSION['id_login'] = $admin['id'];
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        } else {
            // login gagal
            echo "<script>alert('Maaf, Anda Tidak bisa masuk');</script>";
        }
    }
}
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

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login Admin</div>
      <div class="card-body">
        <form action="login.php" method="post">
          <div class="form-group">
            <div class="form-label-group">
                <input type="text" name="username" id="inputEmail" class="form-control" placeholder="ID" required="required" autofocus="autofocus">
              <label for="inputEmail">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <button type="submit" name="login" class="btn btn-success btn-block">Masuk</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>

