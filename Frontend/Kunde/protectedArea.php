<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="../login/kundenlogin.php">einloggen</a>');
}
 
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
 
echo "Hallo User: ".$userid;
?>