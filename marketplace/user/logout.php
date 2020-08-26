<?php
session_start();
include('includes/config.php');
$_SESSION['id_login'] == "";
session_unset();
session_destroy();
?>
<script language="javascript">
    document.location = "login.php";
</script>