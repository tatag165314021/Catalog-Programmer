<?php
ini_set('sisplay_errors',1);
error_reporting(E_ALL);
$from="bantuan@orcois.tech";
$to="andreasyanpratama@gmail.com";
$subject="fsdfsdf";
$message="sadasd";
$headers="From:".$from;
mail($to,$subject,$message,$headers);
echo "the email";


?>