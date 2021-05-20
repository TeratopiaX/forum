<?php

$server = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'finalproject';
 
// $conn = new mysqli($server, $username, $password, $database, $port);
$conn = new mysqli($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);

if ($conn->connect_error)
{
    exit('Error: could not establish database connection');
}
if(!mysqli_select_db($conn, $database))
{
    exit('Error: could not select the database');
}
?>