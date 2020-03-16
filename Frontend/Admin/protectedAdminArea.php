<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="../login/adminlogin.php">einloggen</a>');
}
 
//Abfrage der Admin-ID vom Login
$userid = $_SESSION['userid'];
 
echo "Hallo Admin: ".$userid;
?>