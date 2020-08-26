<?php
include('includes/config.php');
error_reporting(0);
$id   = $_GET['sid'];
// query SQL untuk insert data
try{
    $query="update user set aktif=0 where user_id='$id'";
    mysqli_query($con, $query) or die(mysqli_error());;
    // mengalihkan ke halaman index.php
    echo "<script type='text/javascript'> alert('Berhasil Memblok');</script>";
    header("location:tabel.php");
} catch (Exception $ex) {
    echo "<script type='text/javascript'> alert('Gagal Memblok');</script>";
}
?>

