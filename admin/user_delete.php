<?php
include('includes/config.php');
error_reporting(0);
$from="bantuan@orcois.tech";

$id   = $_GET['sid'];
// query SQL untuk insert data
try{
    
    $checkEmail = mysqli_query($con,"SELECT * FROM user WHERE user_id='$id'");
    $user = mysqli_fetch_assoc($checkEmail);
    $email = $user['email'];
    
    $subject="Pemberitahuan Penghapusan Akun Oleh Admin Orcois";
    $message="Akun Anda Telah Dihapus Oleh Admin";
    $headers="From:".$from;
    mail($email,$subject,$message,$headers);
    
    $query1="DELETE FROM `user` WHERE user_id='$id'";
    $query2="DELETE FROM `skills` WHERE user_id='$id'";
    
    mysqli_query($con, $query2) or die(mysqli_error());
    mysqli_query($con, $query1) or die(mysqli_error());
    // mengalihkan ke halaman index.php
    echo "<script type='text/javascript'> alert('Berhasil Menghapus User');</script>";
    header("location:tabel_blokir.php");
} catch (Exception $ex) {
    echo "<script type='text/javascript'> alert('Gagal Menghapus User');</script>";
}
?>

