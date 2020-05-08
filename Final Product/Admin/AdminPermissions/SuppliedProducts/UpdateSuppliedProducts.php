<?php
require 'config.php';

$sql = "UPDATE suppliedproducts SET  
     SupplierID = :SupplierID,  
     SupplierName = :SupplierName, 
     DeliveryTime = :DeliveryTime,  
     ItemCost = :ItemCost,  
     VATCost = :VATCost,
     TotalCost = :TotalCost,
     ProductCode = :ProductCode  
            WHERE SuppliedProductsID = :SuppliedProductsID"
			;
			
$sqlQuery = $pdo->prepare($sql);                                  
 
$sqlQuery->bindParam(':SuppliedProductsID', $_POST['SuppliedProductsID'], PDO::PARAM_INT); 
$sqlQuery->bindParam(':SupplierID', $_POST['SupplierID'], PDO::PARAM_STR);       
$sqlQuery->bindParam(':SupplierName', $_POST['SupplierName'], PDO::PARAM_STR);    
$sqlQuery->bindParam(':DeliveryTime', $_POST['DeliveryTime'], PDO::PARAM_STR);
$sqlQuery->bindParam(':ItemCost', $_POST['ItemCost'], PDO::PARAM_STR); 
$sqlQuery->bindParam(':VATCost', $_POST['VATCost'], PDO::PARAM_STR);   
$sqlQuery->bindParam(':TotalCost', $_POST['LowStockLevel'], PDO::PARAM_INT);    
$sqlQuery->bindParam(':ProductCode', $_POST['ProductCode'], PDO::PARAM_INT); 
$sqlQuery->execute(); 


echo "<h1  align=center>Supplied Product updated</h1>";
header('Refresh: 5; URL=../../adminpage.php');
?>
