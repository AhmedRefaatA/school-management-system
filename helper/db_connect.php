<?php






session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

$host = "localhost";
$dbName = "school";
$user = "root";
$password = "011199";


$connect = mysqli_connect($host, $user, $password, $dbName);

if(!$connect){
    dir("Error : ".mysqli_connect_error());
   //echo "done";
}
?>