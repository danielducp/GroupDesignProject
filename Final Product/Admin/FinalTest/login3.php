<?php
 
include 'config.php';
 
if(isset($_POST['uname'])) {
    $query = "SELECT `password` FROM `users` WHERE `uname` = ?";
    $params = array($_POST['uname']);
    $results = dataQuery($query, $params);
}
 
$hash = $results[0]['password']; // first and only row if username exists;
 
echo password_verify($_POST['upassword'], $hash) ? 'password correct' : 'passwword incorrect';
 
?>