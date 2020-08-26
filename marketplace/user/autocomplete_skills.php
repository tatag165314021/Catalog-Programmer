<?php
//$host = '203.114.74.62';
//$username = 'orcoiste_root';
//$pass = 'sumaterad11b';
//$Dbname = 'orcoiste_root';
//connect with the database
include('includes/config.php');
//$db = new mysqli($host,$username,$pass,$Dbname);
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
//$query = $db-query("SELECT * FROM autocomplete_skills WHERE skill LIKE '%".$searchTerm."%' ORDER BY id ASC");
$queryAuto = mysqli_query($con, "SELECT * FROM autocomplete_skills WHERE skill_name LIKE '%".$searchTerm."%' ORDER BY id ASC");
while ($rowAuto = mysqli_fetch_array($queryAuto)) {
    $data[] = $rowAuto['skill_name'];
}
//return json data
echo json_encode($data);
?>