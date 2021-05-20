<?php
session_start();
session_destroy();
include 'connect.php';
include 'header.php';

echo 'You have been successfully signed out.';
 
include 'footer.php';
?>