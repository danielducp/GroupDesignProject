<?php


require 'config.php';

$sql = "UPDATE newstaff SET  
           
           password = :password, PasswordNeedsResetting = 0
            

            WHERE staffid = :staffid"
			;
            
            $hash = password_hash( $_POST['upassword'], PASSWORD_DEFAULT);

$sqlQuery = $pdo->prepare($sql);                                  
$sqlQuery->bindParam(':password', $hash , PDO::PARAM_STR);    
$sqlQuery->bindParam(':staffid', $_POST['staffid'], PDO::PARAM_STR); 
$sqlQuery->execute(); 

echo "<h1  align=center>User updated</h1>";

?>




