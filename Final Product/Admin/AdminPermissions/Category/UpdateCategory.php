<?php
require 'config.php';

$sql = "UPDATE category SET  
            CategoryName = :CategoryName
            WHERE CategoryID = :CategoryID"
			;
			
$sqlQuery = $pdo->prepare($sql);                                  
$sqlQuery->bindParam(':CategoryName', $_POST['CategoryName'], PDO::PARAM_STR);       
 
$sqlQuery->bindParam(':CategoryID', $_POST['CategoryID'], PDO::PARAM_INT); 
$sqlQuery->execute(); 

echo "<h1  align=center>Category updated</h1>";
header('Refresh: 5; URL=../../adminpage.php');
?>
