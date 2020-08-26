<?php
include('includes/config.php');
error_reporting(0);
$id   = $_GET['sid'];
// query SQL untuk insert data
try{
    $query="DELETE from skills where id='$id'";
    mysqli_query($con, $query) or die(mysqli_error());;
    // mengalihkan ke halaman index.php
    echo "<script type='text/javascript'> alert('Berhasil Mengubah');</script>";
    header("location:change_profile.php");
} catch (Exception $ex) {
    echo "<script type='text/javascript'> alert('Gagal Mengubah');</script>";
}

?>