<?php
    session_start() ;
	
		require 'config.php';

	$staffid=$_POST['staffid'];


/*
 * name:        PDO Login
 * author:      Jay Blanchard
 * date:        April 2015
 */

include 'pdo_connect.php';

if(isset($_POST['staffid'] )) {
    $query = "SELECT `staffid` FROM `newstaff` WHERE `staffid` = ?";
    $params = array($_POST['staffid']);
    $results = dataQuery($query, $params);
}
echo $staffid. ", you have requested to reset your password!";
header("refresh:5;url=..Homepage.php");
$sqlQuery = $pdo->prepare('UPDATE `newstaff` SET PasswordNeedsResetting = 1 WHERE staffid = :staffid');


$sqlQuery->execute(['staffid' => $staffid]);
   
?>




