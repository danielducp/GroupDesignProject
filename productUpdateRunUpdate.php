
 <?php
require 'config.php';

$sql = "UPDATE product SET ProductCode = :ProductCode, ProductName = :ProductName, 
ProductImage = :ProductImage,  
QuantityPerPack = :QuantityPerPack, 
CategoryID = :CategoryID,  
CurrentStockLevel = :CurrentStockLevel,  
LowStockLevel = :LowStockLevel

WHERE ProductID = :ProductID"
			;
			
         $sqlQuery = $pdo->prepare($sql);                                  
         $sqlQuery->bindParam(':ProductCode', $_POST['ProductCode']);       
         $sqlQuery->bindParam(':ProductName', $_POST['ProductName']);    
         $sqlQuery->bindParam(':ProductImage', $_POST['ProductImage']);
         $sqlQuery->bindParam(':QuantityPerPack', $_POST['QuantityPerPack']); 
         $sqlQuery->bindParam(':CategoryID', $_POST['CategoryID']);   
         $sqlQuery->bindParam(':CurrentStockLevel', $_POST['CurrentStockLevel']);   
         $sqlQuery->bindParam(':LowStockLevel', $_POST['LowStockLevel']); 
         $sqlQuery->bindParam(':ProductID', $_POST['ProductID']); 
         
         $sqlQuery->execute(); 
 



echo "<h1  align=center>Product updated</h1>";
   header('Refresh: 5; URL=adminpage.php');
?>
