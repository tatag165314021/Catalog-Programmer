<?php
session_start();
include('includes/config.php');

function encrypted($kode){
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
	$encryption = openssl_encrypt($kode, $ciphering, 
            $encryption_key, $options, $encryption_iv); 
	return $encryption;
}

if (isset($_POST['login'])) {
    $email = @$_POST['email'];
    $password =@$_POST['password'];
//    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    if (empty($email)) {
        array_push($errors, "Username required");
    }
    if (empty($password)) {
        array_push($errors, "Password required");
    }
    if (empty($errors)) {
        // ambil data dari database
        $pass = encrypted($password);
        $query = mysqli_query($con,"SELECT * FROM user WHERE email='$email' and password='$pass'");
        $user = mysqli_fetch_assoc($query);
 
 
        
// bandingkan password yang dikirim dari form login dengan password
// yang ada di database
        if (mysqli_num_rows($query)>0) {
            // login berhasil
            $_SESSION['id_login'] = $user['user_id'];
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        } else {
            // login gagal
            echo "<script>alert('Maaf, Anda Tidak bisa masuk');</script>";
        }
//        if ($jum_hasil > 0) {
//            $_SESSION['id_login'] = $row['user_id'];
//            
//            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
//        } else {
//            echo "<script>alert('Maaf, Anda Tidak bisa masuk');</script>";
//        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CODER | LOGIN</title>
        <link rel="shortcut icon" href="assets/img/orcois_logo.png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <style type="text/css">
            .body{
                color: #fff;
                background: #CDCCC8;
                font-family: 'Roboto', sans-serif;
            }
            .login-form {
                width: 340px;
                margin: 50px auto;
            }
            .login-form form {
                margin-bottom: 15px;
                background: #f2f3f7;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                padding: 30px;
                border-radius: 10px;
            }
            .login-form h2 {
                margin: 0 0 15px;
            }
            .form-control, .btn {
                min-height: 38px;
                border-radius: 10px;
            }
            .btn {        
                font-size: 15px;
                font-weight: bold;
            }
        </style>
    </head>
    <body class="body">
        <div class="login-form">
            <form action="login.php" method="post">
                <h2 class="text-center" style="color: black">LOGIN</h2>       
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="email" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                    <button type="submit" name="login" class="btn btn-success btn-block">Masuk</button>
                </div>
                <div class="form-group">
                    <p class="text-center"><a href="forgot_password.php"><b style="color: black">Lupa Password ?</b></a></p>
                </div>
            </form>
            <p class="text-center"><a href="register.php"><b style="color: black">Buat Akun</b></a></p>
            
            <p class="text-center"><a href="../index.php"><b style="color: black">Kembali</b></a></p>
        </div>
    </body>
</html>                                		                            