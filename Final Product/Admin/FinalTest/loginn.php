<?php
 
include 'config.php';
 
if(isset($_POST['StaffID'])) {
    $query = "SELECT `password` FROM `staff` WHERE `StaffID` = ?";
    $params = array($_POST['StaffID']);
    $results = dataQuery($query, $params);
}
 
$hash = $results[0]['password']; // first and only row if username exists;
 
echo password_verify($_POST['Password'], $hash) ? 'password correct' : 'passwword incorrect';
 
?>