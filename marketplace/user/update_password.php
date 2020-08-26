<?php

include('includes/config.php');
error_reporting(0);
$user_id = $_POST['user_id'];
$pass_lama = $_POST['password_lama'];
$pass_baru = $_POST['password_baru'];

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

if(($_POST['password_baru'] == $_POST['konfirm_password_baru'])){
    try {
        $query = mysqli_query($con, "SELECT * FROM user WHERE user_id='$user_id'");
        $user = mysqli_fetch_assoc($query);

        // bandingkan password yang dikirim dari form login dengan password
        // yang ada di database
        if (encrypted($pass_lama) == $user['password']) {
            //berhasil
            $pass_enkripsi = encrypted($pass_baru);
            $query = "UPDATE `user` SET `password`='" . $pass_enkripsi . "' WHERE `user_id`='" . $user_id . "'";
            mysqli_query($con, $query);
        
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        } else {
            //gagal
            echo "<script>alert('Maaf, Password Lama Salah');</script>";
            echo "<script type='text/javascript'> document.location = 'change_password.php'; </script>";
        }
    } catch (Exception $ex) {
        echo "<script type='text/javascript'> document.location = 'change_password.php'; </script>";
    }
}else{
    echo "<script>alert('Maaf, Password Baru dan Konfirmasi Tidak Cocok');</script>";
    echo "<script type='text/javascript'> document.location = 'change_password.php'; </script>";
}


?>

