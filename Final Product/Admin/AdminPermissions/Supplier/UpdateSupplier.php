<?php
require 'config.php';

$sql = "UPDATE supplier SET  
   
            SupplierName = :SupplierName, 
            SupplierAddress = :SupplierAddress 
           
            WHERE SupplierID = :SupplierID"  ;

$sqlQuery = $pdo->prepare($sql);                                  
$sqlQuery->bindParam(':SupplierID', $_POST['SupplierID'], PDO::PARAM_STR);       
$sqlQuery->bindParam(':SupplierName', $_POST['SupplierName'], PDO::PARAM_STR);    
$sqlQuery->bindParam(':SupplierAddress', $_POST['SupplierAddress'], PDO::PARAM_STR);

$sqlQuery->execute(); 

echo "<h1  align=center>Supplier updated</h1>";
header('Refresh: 5; URL=../../adminpage.php');
?>
