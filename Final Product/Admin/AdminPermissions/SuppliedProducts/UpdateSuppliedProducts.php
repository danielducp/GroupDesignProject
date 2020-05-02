<?php
require 'config.php';

$sql = "UPDATE suppliedproducts SET  
            CategoryName = :CategoryName
            WHERE SuppliedProductsID = :SuppliedProductsID"
			;
			
$sqlQuery = $pdo->prepare($sql);                                  
$sqlQuery->bindParam(':CategoryName', $_POST['CategoryName'], PDO::PARAM_STR);       
 
$sqlQuery->bindParam(':SuppliedProductsID', $_POST['SuppliedProductsID'], PDO::PARAM_INT); 
$sqlQuery->execute(); 

echo "<h1  align=center>Category updated</h1>";
   header('Refresh: 5; URL=../adminpage.php');
?>
