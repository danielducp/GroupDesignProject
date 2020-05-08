<?php
require 'config.php';

$sql = "UPDATE product SET  
            ProductName = :ProductName,  
            ProductImage = :ProductImage, 
            QuantityPerPack = :QuantityPerPack,  
            CategoryID = :CategoryID,  
            CurrentStockLevel = :CurrentStockLevel,
            LowStockLevel = :LowStockLevel
            

            WHERE ProductCode = :ProductCode"
			;
			
$sqlQuery = $pdo->prepare($sql);                                  
$sqlQuery->bindParam(':ProductName', $_POST['ProductName'], PDO::PARAM_STR);       
$sqlQuery->bindParam(':ProductImage', $_POST['ProductImage'], PDO::PARAM_STR);    
$sqlQuery->bindParam(':QuantityPerPack', $_POST['QuantityPerPack'], PDO::PARAM_STR);
$sqlQuery->bindParam(':CategoryID', $_POST['CategoryID'], PDO::PARAM_STR); 
$sqlQuery->bindParam(':CurrentStockLevel', $_POST['CurrentStockLevel'], PDO::PARAM_STR);   
$sqlQuery->bindParam(':LowStockLevel', $_POST['LowStockLevel'], PDO::PARAM_INT);    
$sqlQuery->bindParam(':ProductCode', $_POST['ProductCode'], PDO::PARAM_INT); 
$sqlQuery->execute(); 

echo "<h1  align=center>Product updated</h1>";
   header('Refresh: 5; URL=../../adminpage.php');
?>
