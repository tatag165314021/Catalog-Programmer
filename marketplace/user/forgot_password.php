<?php
ini_set('sisplay_errors',1);
error_reporting(E_ALL);

include('includes/config.php');

function decrypted($encryption){
	// Store the cipher method 
	$ciphering = "AES-128-CTR"; 
  
	// Use OpenSSl Encryption method 
	$iv_length = openssl_cipher_iv_length($ciphering); 
	$options = 0; 
	
	// Non-NULL Initialization Vector for decryption 
	$decryption_iv = '1234567891011121'; 
  
	// Store the decryption key 
	$decryption_key = "orcoiste"; 
  
	// Use openssl_decrypt() function to decrypt the data 
	$decryption=openssl_decrypt ($encryption, $ciphering,  
        $decryption_key, $options, $decryption_iv); 
  
	return $decryption;
}

$from="bantuan@orcois.tech";

if (isset($_POST['kirim']) and isset($_POST['email'])) {
    $email = @$_POST['email'];
    
    $query = mysqli_query($con,"SELECT * FROM user WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);
    $jum = mysqli_num_rows($query);
    if($jum>0){
        $pass= $user['password'];
        $password = decrypted($pass);
        
        $subject="Pemulihan Password Coder.Orcois.tech";
        $message="Password anda : ".$password;
        $headers="From:".$from;
        mail($email,$subject,$message,$headers);
        
        echo "<script>alert('Email Sudah Terkirim -> Silahkan Cek Email');</script>";
        echo "<script type='text/javascript'> document.location = 'forgot_password.php'; </script>";
    }else{
        echo "<script>alert('Maaf, Ada Belum Mendaftar -> Silahkan Ulangi Lagi');</script>";
        echo "<script type='text/javascript'> document.location = 'forgot_password.php'; </script>";
    }
}
// echo "the email";
?>
<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CODER | LUPA PASSWORD ?</title>
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
            <form action="forgot_password.php" method="post">
                <h2 class="text-center" style="color: black">LUPA PASSWORD</h2>       
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="email" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" name="kirim" class="btn btn-success btn-block">Kirim Pemulihan</button>
                </div>
            </form>
            <p class="text-center"><a href="index.php"><b style="color: black">Kembali</b></a></p>
        </div>
    </body>
</html>                                		                            