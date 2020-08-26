<?php
define('DB_SERVER','203.114.74.62');
define('DB_USER','orcoiste_root');
define('DB_PASS' ,'sumaterad11b');
define('DB_NAME','orcoiste_root');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>