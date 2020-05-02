<?php


require 'config.php';

$sql = "UPDATE newstaff SET  
           stafftitle = :stafftitle,
           staffname = :staffname,
           staffrole = :staffrole,
           storeid = :storeid,
           departmentid = :departmentid,
           password = :password
            

            WHERE staffid = :staffid"
			;
            
            $hash = password_hash( $_POST['upassword'], PASSWORD_DEFAULT);

$sqlQuery = $pdo->prepare($sql); 
$sqlQuery->bindParam(':stafftitle', $_POST['stafftitle'], PDO::PARAM_STR); 

$sqlQuery->bindParam(':staffname', $_POST['staffname'], PDO::PARAM_STR); 
$sqlQuery->bindParam(':staffrole', $_POST['staffrole'], PDO::PARAM_STR); 
$sqlQuery->bindParam(':storeid', $_POST['storeid'], PDO::PARAM_INT);
$sqlQuery->bindParam(':departmentid', $_POST['departmentid'], PDO::PARAM_INT);            
$sqlQuery->bindParam(':password', $hash , PDO::PARAM_STR);    
$sqlQuery->bindParam(':staffid', $_POST['staffid'], PDO::PARAM_STR); 

$sqlQuery->execute(); 

echo "<h1  align=center>User updated</h1>";

?>




