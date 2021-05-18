<?php

$server = 'localhost';
$username   = 'root';
$password   = 'root';
$database   = 'finalproject';
 
$conn = new mysqli($server, $username, $password);

if ($conn->connect_error)
{
    exit('Error: could not establish database connection');
}
if(!mysqli_select_db($conn, $database))
{
    exit('Error: could not select the database');
}
?>