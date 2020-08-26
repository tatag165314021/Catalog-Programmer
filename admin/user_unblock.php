<?php
include('includes/config.php');
error_reporting(0);
$id   = $_GET['sid'];
// query SQL untuk insert data
try{
    $query="update user set aktif=1 where user_id='$id'";
    mysqli_query($con, $query) or die(mysqli_error());;
    // mengalihkan ke halaman index.php
    echo "<script type='text/javascript'> alert('Berhasil Melepas Blok');</script>";
    header("location:tabel_blokir.php");
} catch (Exception $ex) {
    echo "<script type='text/javascript'> alert('Gagal Melepas Blok');</script>";
}
?>

